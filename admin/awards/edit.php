<?php
require_once('awards.php');

$id = $_GET['id'];

$fileHandle = fopen(AWARDS_DATA, 'r');
$awards = [];
while (($line = fgetcsv($fileHandle)) !== FALSE) {
    $awards[] = $line;
}
fclose($fileHandle);

$header = array_shift($awards);
$award = $awards[$id];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year = $_POST['year'];
    $description = $_POST['description'];

    updateAward($id, $year, $description);

    header('Location: detail.php?id=' . $id);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Award</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <h1>Edit Award</h1>
        <form action="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $id ?>" method="POST">
            <div class="form-group">
                <label for="year">Year</label>
                <select class="form-control" id="year" name="year">
                    <?php
                    $startYear = (int)date('Y');
                    $endYear = $startYear - 100;
                    for ($i = $startYear; $i >= $endYear; $i--) {
                        echo "<option value='$i'";
                        if ($i == $award[0]) {
                            echo " selected";
                        }
                        echo ">$i</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="<?= htmlspecialchars($award[1]); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="detail.php?id=<?= $id ?>" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</body>

</html>