<?php



class Category {
    private $id;
    private $name;
    private $description;
    private $createdAt;
    private $updatedAt;

    public function __construct(
        int $id,
        string $name,
        string $description,
        DateTime $createdAt,
        DateTime $updatedAt
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    // Getters et Setters...

    public function getProducts(): array {
        // Configuration de la connexion à la base de données
        $host = 'localhost';
        $dbname = 'draft_shop';
        $username = 'root';
        $password = '';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }

        // Requête pour récupérer les produits associés à la catégorie
        $query = $pdo->prepare("SELECT * FROM product WHERE category_id = :category_id");
        $query->bindParam(':category_id', $this->id, PDO::PARAM_INT);
        $query->execute();

        // Récupérer les données des produits
        $productsData = $query->fetchAll(PDO::FETCH_ASSOC);

        // Tableau pour stocker les instances de Product
        $products = [];

        // Création des instances de Product
        foreach ($productsData as $productData) {
            $products[] = new Product(
                $productData['id'],
                $productData['name'],
                json_decode($productData['photos'], true), // Convertit le JSON en tableau PHP
                $productData['price'],
                $productData['description'],
                $productData['quantity'],
                new DateTime($productData['created_at']),
                new DateTime($productData['updated_at']),
                $productData['category_id']
            );
        }

        return $products;
    }


    // Getters et Setters pour chaque propriété

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
