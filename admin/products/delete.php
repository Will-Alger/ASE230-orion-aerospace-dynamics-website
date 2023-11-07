<?php
require_once('products.php');

$productManager = new ProductManager(PRODUCTS_DATA);
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm']) && $_POST['confirm'] === 'Yes') {
        $productManager->deleteProduct($id);
        header('Location: index.php');
        exit;
    } else {
        header("Location: detail.php?id=" . urlencode($id));
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Confirm Deletion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Are you sure you want to delete this product?</h1>
        <form method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>">
            <button type="submit" name="confirm" value="Yes" class="btn btn-danger mr-2">Yes</button>
            <button type="submit" name="confirm" value="No" class="btn btn-primary">No</button>
        </form>
    </div>
</body>

</html>