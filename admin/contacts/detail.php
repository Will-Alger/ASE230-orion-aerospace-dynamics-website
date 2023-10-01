<?php
require_once('../../config.php');
require_once('../../lib/jsonReader.php');

$contacts = readJsonFile(CONTACTS_DATA);

$index = $_GET['id'];
$contact = $contacts[$index];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <h1>Contact Details</h1>
        <p><strong>Name:</strong> <?= htmlspecialchars($contact['name']); ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($contact['email']); ?></p>
        <p><strong>Subject:</strong> <?= htmlspecialchars($contact['subject']); ?></p>
        <p><strong>Comments:</strong> <?= htmlspecialchars($contact['comments']); ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($contact['date']); ?></p>
        <a href="index.php">Back to Contacts List</a>
    </div>
</body>

</html>