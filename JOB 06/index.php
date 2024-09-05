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

// Inclure les classes Product et Category
require_once 'Product.php';
require_once 'Category.php'; // Assurez-vous que le chemin du fichier Category.php est correct

// Requête SQL pour récupérer la catégorie avec l'id 1
$categoryId = 1;
$query = $pdo->prepare("SELECT * FROM category WHERE id = :id");
$query->bindParam(':id', $categoryId, PDO::PARAM_INT);
$query->execute();

// Récupérer la catégorie sous forme de tableau associatif
$categoryData = $query->fetch(PDO::FETCH_ASSOC);

// Vérifier si une catégorie a été trouvée
if ($categoryData) {
    // Créer une nouvelle instance de la classe Category
    $category = new Category(
        $categoryData['id'],
        $categoryData['name'],
        $categoryData['description'],
        new DateTime($categoryData['created_at']),
        new DateTime($categoryData['updated_at'])
    );

    // Récupérer les produits associés à la catégorie
    $products = $category->getProducts();

    // Afficher les détails des produits
    echo "Produits associés à la catégorie avec l'id $categoryId :\n";
    foreach ($products as $product) {
        var_dump($product);
    }
} else {
    echo "Aucune catégorie trouvée avec l'id $categoryId.\n";
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