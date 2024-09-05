<?php
// Inclure les classes Category et Product
require_once 'Category.php';
require_once 'Product.php';

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

// Requête SQL pour récupérer le produit avec l'id 7
$productId = 7;
$query = $pdo->prepare("SELECT * FROM product WHERE id = :id");
$query->bindParam(':id', $productId, PDO::PARAM_INT);
$query->execute();

// Récupérer le produit sous forme de tableau associatif
$productData = $query->fetch(PDO::FETCH_ASSOC);

// Vérifier si un produit a été trouvé
if ($productData) {
    // Inclure les classes Product et Category
    require_once 'Product.php';
    require_once 'Category.php'; // Assurez-vous que le chemin du fichier Category.php est correct

    // Créer une nouvelle instance de la classe Product en utilisant les données récupérées
    $product = new Product(
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

    // Récupérer la catégorie associée au produit
    $category = $product->getCategory();

    // Afficher les détails du produit et de la catégorie
    echo "Détails du produit hydraté depuis la base de données :\n";
    var_dump($product);

    if ($category) {
        echo "Détails de la catégorie associée :\n";
        var_dump($category);
    } else {
        echo "Aucune catégorie trouvée pour le produit avec l'id $productId.\n";
    }
} else {
    echo "Aucun produit trouvé avec l'id $productId.\n";
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job03</title>
</head>

<body>

</body>

</html>