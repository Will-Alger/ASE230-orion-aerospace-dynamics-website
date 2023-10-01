<?php
require_once('team.php');

$id = $_GET['id'];

if ($_POST) {
    if (isset($_POST['confirm']) && $_POST['confirm'] === 'Yes') {

        deleteMember($id);

        header('Location: index.php');
        exit;
    } else {
        header("Location: detail.php?id=$id");
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
        <h1 class="mb-4">Are you sure you want to delete?</h1>
        <form method="post">
            <button type="submit" name="confirm" value="Yes" class="btn btn-danger mr-2">Yes</button>
            <button type="submit" name="confirm" value="No" class="btn btn-primary">No</button>
        </form>
    </div>
</body>

</html>