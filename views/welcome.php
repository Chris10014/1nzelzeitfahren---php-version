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
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <title>1nzelzeitahren - <?= SITETITLE ?></title>
    <style>
        body {
            background-color: #343a40;
        }
    </style>
</head>

<body>
    <header>
        <div class="text-center" id="headprint">
            <img src="<?= DIR ?>static/img/racelogos/1zFSchriftzugGeradeTraining_white-min.svg" alt="1zF" width-max="100%">
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= DIR ?>"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= DIR ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= DIR ?>registration/index/1">Anmeldung</a>
                        </li>
                        <li class=" nav-item">
                            <a class="nav-link" href="<?= DIR ?>athletes/rules">Ausschreibung</a>
                        </li>
                        <li class=" nav-item">
                            <a class="nav-link" href="<?= DIR ?>events/participants/1">Teilnehmerliste</a>
                        </li>
                        <li class=" nav-item">
                            <a class="nav-link" href="<?= DIR ?>events/results/1">Ergebnisse</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="text-center">
            <p><?= Message::show() ?></p>
            <p><img src="<?= DIR ?>static/img/racelogos/winnerwheel.png" alt="Siegertafel"></p>
        </div>
    </main>
    <footer></footer>
</body>

</html>