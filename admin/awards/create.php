<?php
require_once('../../config.php');
require_once('awards.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $year = $_POST['year'];
    $description = $_POST['description'];

    addAward($year, $description);

    $lines = count(file(root . awards));
    header('Location: detail.php?id=' . ($lines - 2));

    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Award</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <h1>Add New Award</h1>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="form-group">
                <label for="year">Year</label>
                <select class="form-control" id="year" name="year">
                    <?php
                    $startYear = (int)date('Y');
                    $endYear = $startYear - 100;
                    for ($i = $startYear; $i >= $endYear; $i--) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description">
            </div>
            <button type="submit" class="btn btn-primary">Add Award</button>
            <a href="index.php" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</body>

</html>