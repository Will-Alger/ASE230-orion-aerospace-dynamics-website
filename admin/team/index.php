<?php
require_once('../../config.php');
require_once('team.php');
require_once('../../lib/jsonReader.php');

$team = getMembers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Team</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($team as $index => $member) :
                ?>
                    <tr>
                        <td><a href="detail.php?id=<?= $index; ?>"><?= htmlspecialchars($member['name']); ?></a></td>
                        <td><img src="<?= "../../images/team/" . $member['img']; ?>" alt="<?= htmlspecialchars($member['name']); ?>" style="height:100px;width:auto;"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="create.php" class="btn btn-success">Add Member</a>
    </div>
</body>

</html>