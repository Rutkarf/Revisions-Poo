<?php


class Product
{
    private $id;
    private $name;
    private $photos;
    private $price;
    private $description;
    private $quantity;
    private $createdAt;
    private $updatedAt;
    private $category_id;

    public function __construct($id, $name, $photos, $price, $description, $quantity, $createdAt, $updatedAt, $category_id)
    {
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

    public static function findAll()
    {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=draft_shop;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->query('SELECT * FROM product');
            $products = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $createdAt = isset($row['createdAt']) ? new DateTime($row['createdAt']) : null;
                $updatedAt = isset($row['updatedAt']) ? new DateTime($row['updatedAt']) : null;

                $product = new Product(
                    $row['id'],
                    $row['name'],
                    json_decode($row['photos'], true),
                    $row['price'],
                    $row['description'],
                    $row['quantity'],
                    $createdAt,
                    $updatedAt,
                    $row['category_id']
                );
                $products[] = $product;
            }

            return $products;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return [];
        }
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPhotos()
    {
        return $this->photos;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    public function getCategoryId()
    {
        return $this->category_id;
    }
}
