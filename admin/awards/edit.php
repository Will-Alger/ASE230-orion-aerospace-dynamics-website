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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year = $_POST['year'];
    $description = $_POST['description'];

    $newData = [
        'year' => $year,
        'description' => $description
    ];

    $awardManager->updateAward($id, $newData);

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
        <form action="edit.php?id=<?= urlencode($id) ?>" method="POST">
            <div class="form-group">
                <label for="year">Year</label>
                <select class="form-control" id="year" name="year">
                    <?php
                    $startYear = (int)date('Y');
                    $endYear = $startYear - 100;
                    for ($i = $startYear; $i >= $endYear; $i--) {
                        echo "<option value='$i'";
                        if ($i == $award->year) {
                            echo " selected";
                        }
                        echo ">$i</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="<?= htmlspecialchars($award->description); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="detail.php?id=<?= urlencode($award->id) ?>" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</body>

</html>