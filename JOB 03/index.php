<?php
// Inclure les classes Category et Product
require_once 'Category.php';
require_once 'Product.php';



// Configuration de la connexion à la base de données
$host = 'localhost'; // Hôte de la base de données
$dbname = 'draft_shop'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur de la base de données (par défaut 'root')
$password = ''; // Mot de passe de la base de données (par défaut vide sur certains serveurs locaux)

// Création de la connexion PDO
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
    // Inclure la classe Product
    require_once 'Product.php'; // Assurez-vous que le chemin du fichier Product.php est correct

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
        $productData['category_id'] // Assurez-vous d'inclure cet argument
    );

    // Afficher l'instance de Product pour vérifier l'hydratation
    echo "Détails du produit hydraté depuis la base de données :\n";
    var_dump($product);
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