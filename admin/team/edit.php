<?php
require_once('team.php');

$id = $_GET['id'];
$members = getMembers();

if (!isset($members[$id])) {
    die("Invalid member ID");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $description = $_POST['description'];
    $file_name = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $allowed_extensions = array("jpeg", "jpg", "png");

        if (!in_array($file_ext, $allowed_extensions)) {
            die("Extension not allowed, please choose a JPEG or PNG file.");
        }

        if (!move_uploaded_file($file_tmp, "../../images/team/" . $file_name)) {
            die("Error uploading the file");
        }
    }

    $updatedMember = ['name' => "test", 'position' => 'test', 'description' => 'test', 'img' => 'test'];
    updateMember(0, $updatedMember);

    if (!updateMember($id, $updatedMember)) {
        die("Error updating member");
    }

    header("Location: detail.php?id=$id");
    exit;
}

$member = $members[$id];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                <h1>Edit <?= htmlspecialchars($member['name']); ?></h1>
            </div>
            <div class="card-body">
                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>?id=<?= $id; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($member['name']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="position">Position</label>
                        <input type="text" class="form-control" id="position" name="position" value="<?= htmlspecialchars($member['position']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"><?= htmlspecialchars($member['description']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Upload Image (Current: <?= htmlspecialchars($member['img']); ?>)</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="detail.php?id=<?= $id; ?>" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>