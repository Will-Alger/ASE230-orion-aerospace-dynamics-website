<?php
require_once('../../config.php');
require_once('../../lib/jsonReader.php');

$contacts = readJsonFile(CONTACTS_DATA);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts Data</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $index => $contact) : ?>
                    <tr>
                        <td><a href="detail.php?id=<?= $index ?>"><?= htmlspecialchars($contact['email']); ?></a></td>
                        <td><?= htmlspecialchars($contact['date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>