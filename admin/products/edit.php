<?php
require_once('products.php');

$productManager = new ProductManager(PRODUCTS_DATA);
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // Make sure to sanitize this input
    $name = $_POST['name']; // and these as well
    $description = $_POST['description'];

    $applications = [];
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'application_name_') === 0) {
            $appNumber = explode('_', $key)[2];
            $appDescription = $_POST['application_desc_' . $appNumber];
            $applications[$value] = $appDescription;
        }
    }

    $productManager->updateProduct($id, [
        'name' => $name,
        'description' => $description,
        'applications' => $applications,
    ]);

    header('Location: detail.php?id=' . urlencode($id));
    exit;
}

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
    <title>Edit Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <h1>Edit Product</h1>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $product->name ?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="<?= $product->description ?>">
            </div>
            <div id="applications">

            </div>
            <button type="button" id="add_application" class="btn btn-secondary">Add More Applications</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="index.php" class="btn btn-danger">Cancel</a>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var i = 0;
            $("#add_application").click(function() {
                i++;
                let template = `
                <div class="form-group d-flex">
                    <div class="mr-2" style="flex: 1;">
                        <label for="application_name_${i}">Application Name ${i}</label>
                        <input type="text" class="form-control" id="application_name_${i}" name="application_name_${i}">
                    </div>
                    <div style="flex: 1;">
                        <label for="application_desc_${i}">Application Description ${i}</label>
                        <input type="text" class="form-control" id="application_desc_${i}" name="application_desc_${i}">
                    </div>
                </div>`;

                $("#applications").append(template);
            });

            var applications = <?= json_encode($product->applications) ?>;

            for (var appName in applications) {
                i++;
                let appDesc = applications[appName];
                let template = `
                <div class="form-group d-flex">
                    <div class="mr-2" style="flex: 1;">
                        <label for="application_name_${i}">Application Name ${i}</label>
                        <input type="text" class="form-control" id="application_name_${i}" name="application_name_${i}" value="${appName}">
                    </div>
                    <div style="flex: 1;">
                        <label for="application_desc_${i}">Application Description ${i}</label>
                        <input type="text" class="form-control" id="application_desc_${i}" name="application_desc_${i}" value="${appDesc}">
                    </div>
                </div>`;

                $("#applications").append(template);
            }
        });
    </script>
</body>

</html>