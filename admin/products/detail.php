<?php
require_once('products.php');

$productManager = new ProductManager(PRODUCTS_DATA);
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

$product = $productManager->getProduct($id);

if (!$product) {
    die("Invalid product ID");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                <h1><?= htmlspecialchars($product->name); ?></h1>
            </div>
            <div class="card-body">
                <p class="card-text"><?= htmlspecialchars($product->description); ?></p>

                <h2 class="mt-4">Applications</h2>
                <?php foreach ($product->applications as $application => $details) : ?>
                    <h4 class="mt-3"><?= htmlspecialchars($application); ?></h4>
                    <p><?= htmlspecialchars($details); ?></p>
                <?php endforeach; ?>

                <div class="mt-4">
                    <a href="edit.php?id=<?= urlencode($product->id) ?>" class="btn btn-primary">Edit</a>
                    <a href="delete.php?id=<?= urlencode($product->id) ?>" class="btn btn-danger">Delete</a>
                    <a href="index.php" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>