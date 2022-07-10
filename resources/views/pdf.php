<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php foreach ($transaction as $tr) { ?>
        <ul>
            <li><?= $tr["user_id"]; ?></li>
        </ul>
    <?php } ?>
</body>

</html>
