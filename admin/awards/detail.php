<?php
require_once('awards.php');
$awardManager = new AwardManager(AWARDS_DATA);

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

if ($id === null) {
    die('No award ID provided.');
}

$award = $awardManager->getAward($id);

if (!$award) {
    die('Award not found.');
}

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
                <li class="list-group-item"><strong>ID:</strong> <?= htmlspecialchars($award->id); ?></li>
                <li class="list-group-item"><strong>Year:</strong> <?= htmlspecialchars($award->year); ?></li>
                <li class="list-group-item"><strong>Description:</strong> <?= htmlspecialchars($award->description); ?></li>
            </ul>
        </div>
        <div class="mt-4">
            <a href="edit.php?id=<?= urlencode($award->id) ?>" class="btn btn-primary mr-2">Edit</a>
            <a href="delete.php?id=<?= urlencode($award->id) ?>" class="btn btn-danger mr-2">Delete</a>
            <a href="index.php" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</body>

</html>