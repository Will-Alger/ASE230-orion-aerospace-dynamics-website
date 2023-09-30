<?php
require_once('../../config.php');
require_once('awards.php');

$id = $_GET['id'];

$awards = getAwards(root . awards);
$header = array_shift($awards);
$award = $awards[$id];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail of Award</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Award Details</h1>
        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong><?= htmlspecialchars($header[0]); ?>:</strong> <?= htmlspecialchars($award[0]); ?></li>
                <li class="list-group-item"><strong><?= htmlspecialchars($header[1]); ?>:</strong> <?= htmlspecialchars($award[1]); ?></li>
            </ul>
        </div>
        <div class="mt-4">
            <a href="edit.php?id=<?= $id ?>" class="btn btn-primary mr-2">Edit</a>
            <a href="delete.php?id=<?= $id ?>" class="btn btn-danger mr-2">Delete</a>
            <a href="index.php" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</body>

</html>