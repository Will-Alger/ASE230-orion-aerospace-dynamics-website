<?php
require_once('awards.php');

$awards = getAwards(AWARDS_DATA);

$header = array_shift($awards);
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
        <table class="table table-striped">
            <thead>
                <tr>
                    <?php foreach ($header as $head) : ?>
                        <th><?= htmlspecialchars($head); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($awards as $index => $award) : ?>
                    <tr>
                        <td><a href="detail.php?id=<?= $index ?>"><?= htmlspecialchars($award[0]); ?></a></td>
                        <td><?= htmlspecialchars($award[1]); ?></td>
                    </tr>
                <?php endforeach; ?>
        </table>
        <a href="create.php" class="btn btn-success">Add New Award</a>
    </div>
</body>

</html>