<?php



class Product {
    private $id;
    private $name;
    private $photos;
    private $price;
    private $description;
    private $quantity;
    private $createdAt;
    private $updatedAt;
    private $category_id;

    public function __construct(
        int $id,
        string $name,
        array $photos,
        int $price,
        string $description,
        int $quantity,
        DateTime $createdAt,
        DateTime $updatedAt,
        int $category_id
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->category_id = $category_id;
    }

    // Getters et Setters...

    public static function findOneById(int $id) {
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

        // Requête pour récupérer le produit par ID
        $query = $pdo->prepare("SELECT * FROM product WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        // Récupérer les données du produit
        $productData = $query->fetch(PDO::FETCH_ASSOC);

        // Vérifier si le produit existe
        if ($productData) {
            return new self(
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
        } else {
            return false;
        }
    }



    // Getter and Setter methods...

    public function getCategory(): ?Category {
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

        // Requête pour récupérer la catégorie par son ID
        $query = $pdo->prepare("SELECT * FROM category WHERE id = :id");
        $query->bindParam(':id', $this->category_id, PDO::PARAM_INT);
        $query->execute();

        // Récupérer les données de la catégorie
        $categoryData = $query->fetch(PDO::FETCH_ASSOC);

        // Vérifier si la catégorie a été trouvée
        if ($categoryData) {
            // Créer une instance de la classe Category
            return new Category(
                $categoryData['id'],
                $categoryData['name'],
                $categoryData['description'],
                new DateTime($categoryData['created_at']),
                new DateTime($categoryData['updated_at'])
            );
        }

        return null; // Retourner null si aucune catégorie n'est trouvée
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

    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function setPhotos(array $photos): void
    {
        $this->photos = $photos;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
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

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }
}
