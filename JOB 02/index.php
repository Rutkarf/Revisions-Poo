<?php
// Inclure les classes Category et Product
require_once 'Category.php';
require_once 'Product.php';

// Créer un objet DateTime pour les dates de création et de mise à jour
$createdAt = new DateTime('2023-09-01');
$updatedAt = new DateTime('2023-09-05');

// Instancier la classe Product
$product = new Product(
    1,                             // id
    "Laptop",                      // name
    ["photo1.jpg", "photo2.jpg"],  // photos
    1200,                          // price
    "High-end gaming laptop",      // description
    10,                            // quantity
    $createdAt,                    // createdAt
    $updatedAt                     // updatedAt
);

// Utiliser var_dump() pour afficher les valeurs initiales
echo "Valeurs initiales de l'objet Product :\n";
var_dump($product->getId());
var_dump($product->getName());
var_dump($product->getPhotos());
var_dump($product->getPrice());
var_dump($product->getDescription());
var_dump($product->getQuantity());
var_dump($product->getCreatedAt());
var_dump($product->getUpdatedAt());

// Modifier certaines propriétés avec les setters
$product->setName("Gaming Laptop");
$product->setPrice(1300);
$product->setQuantity(5);
$product->setUpdatedAt(new DateTime()); // Mettre à jour la date de modification avec la date et l'heure actuelles

// Utiliser var_dump() pour afficher les valeurs modifiées
echo "\nValeurs modifiées de l'objet Product :\n";
var_dump($product->getName());
var_dump($product->getPrice());
var_dump($product->getQuantity());
var_dump($product->getUpdatedAt());

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job01</title>
</head>

<body>

</body>

</html>