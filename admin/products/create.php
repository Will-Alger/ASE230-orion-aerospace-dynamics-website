<?php
require_once('products.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $applications = [];
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'application_name_') === 0) {
            $appNumber = explode('_', $key)[2];
            $appDescription = $_POST['application_desc_' . $appNumber];

            $applications[$value] = $appDescription;
        }
    }

    addProduct([
        'name' => $name,
        'description' => $description,
        'applications' => $applications,
    ]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <h1>Add New Product</h1>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description">
            </div>
            <div id="applications">
                <div class="form-group d-flex">
                    <div class="mr-2" style="flex: 1;">
                        <label for="application_name_0">Application Name</label>
                        <input type="text" class="form-control" id="application_name_0" name="application_name_0">
                    </div>
                    <div style="flex: 1;">
                        <label for="application_desc_0">Application Description</label>
                        <input type="text" class="form-control" id="application_desc_0" name="application_desc_0">
                    </div>
                </div>
            </div>
            <button type="button" id="add_application" class="btn btn-secondary">Add More Applications</button>
            <button type="submit" class="btn btn-primary">Submit</button>
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
        });
    </script>
</body>

</html>