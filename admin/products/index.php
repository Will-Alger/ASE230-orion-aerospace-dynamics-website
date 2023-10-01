<?php
require_once('../../config.php');
require_once('../../lib/jsonReader.php');
require_once('products.php');
$products = getProducts();
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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $products = array_values($products);
                foreach ($products as $index => $product) :
                ?>
                    <tr>
                        <td><a href="detail.php?id=<?= $index ?>"><?= htmlspecialchars($product['name']); ?></a></td>
                        <td><?= htmlspecialchars($product['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="create.php" class="btn btn-success">Add New Product</a>
    </div>
</body>

</html>