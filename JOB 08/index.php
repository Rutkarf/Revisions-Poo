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

// Récupérer tous les produits
$products = Product::findAll();

// Afficher les détails de chaque produit
foreach ($products as $product) {
    echo 'ID: ' . $product->getId() . '<br>';
    echo 'Name: ' . $product->getName() . '<br>';
    echo 'Photos: ' . implode(', ', $product->getPhotos()) . '<br>';
    echo 'Price: ' . $product->getPrice() . '<br>';
    echo 'Description: ' . $product->getDescription() . '<br>';
    echo 'Quantity: ' . $product->getQuantity() . '<br>';

    // Vérifiez si les propriétés de date ne sont pas null
    if ($product->getCreatedAt() !== null) {
        echo 'Created At: ' . $product->getCreatedAt()->format('Y-m-d H:i:s') . '<br>';
    } else {
        echo 'Created At: N/A<br>';
    }

    if ($product->getUpdatedAt() !== null) {
        echo 'Updated At: ' . $product->getUpdatedAt()->format('Y-m-d H:i:s') . '<br>';
    } else {
        echo 'Updated At: N/A<br>';
    }

    echo 'Category ID: ' . $product->getCategoryId() . '<br>';
    echo '<hr>';
}
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job08</title>
</head>

<body>

</body>

</html>