<?php
require_once('team.php');

$id = $_GET['id'];
$members = getMembers();

if (!isset($members[$id])) {
    die("Invalid member ID");
}
$member = $members[$id];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                <h1><?= htmlspecialchars($member['name']); ?></h1>
            </div>
            <div class="card-body">
                <p><strong>Position: </strong> <?= htmlspecialchars($member['position']); ?></p>
                <p><strong>Description: </strong> <?= htmlspecialchars($member['description']); ?></p>
                <img src="<?= "../../images/team/" . $member['img']; ?>" alt="<?= htmlspecialchars($member['name']); ?>" style="height:300px;width:auto;">

                <div class="mt-4">
                    <a href="edit.php?id=<?= $id; ?>" class="btn btn-primary">Edit</a>
                    <a href="delete.php?id=<?= $id; ?>" class="btn btn-danger">Delete</a>
                    <a href="index.php" class="btn btn-secondary">Back to Team</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>