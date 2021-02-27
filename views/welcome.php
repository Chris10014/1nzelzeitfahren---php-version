<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>1nzelzeitahren - <?= SITETITLE ?></title>
</head>

<body>

    <h1>Hello</h1>
    <p><?= Message::show() ?></p>

    <p><a href="<?= DIR ?>registration/index/1">Anmeldung zum TSG 1nzelzeitfahren Training</a></p>

    <p><img src="<?= DIR ?>static/img/racelogos/winnerwheel.png" alt="Siegertafel"></p>


</body>

</html>