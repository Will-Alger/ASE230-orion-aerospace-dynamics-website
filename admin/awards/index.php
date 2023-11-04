<?php
require_once('awards.php');
require_once('../utility/CsvHelper.php');
require_once('../../config.php');

$awardManager = new AwardManager(AWARDS_DATA);

$awards = $awardManager->getAwards();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awards Data</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <h1>Awards Data</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Year</th>
                    <th>Award</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($awards as $award) : ?>
                    <tr>
                        <td><a href="detail.php?id=<?= urlencode($award->id) ?>"><?= htmlspecialchars($award->id); ?></a></td>
                        <td><?= htmlspecialchars($award->year); ?></td>
                        <td><?= htmlspecialchars($award->description); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="create.php" class="btn btn-success">Add New Award</a>
    </div>
</body>

</html>