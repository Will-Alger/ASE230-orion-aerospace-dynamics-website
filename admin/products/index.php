<?php
require_once('products.php');
require_once('../../config.php');

$productManager = new ProductManager(PRODUCTS_DATA);
$products = $productManager->getProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Data</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <h1>Our Products</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= htmlspecialchars($product->id); ?></td>
                        <td><a href="detail.php?id=<?= urlencode($product->id) ?>"><?= htmlspecialchars($product->name); ?></a></td>
                        <td><?= htmlspecialchars($product->description); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="create.php" class="btn btn-success">Add New Product</a>
    </div>
</body>

</html>