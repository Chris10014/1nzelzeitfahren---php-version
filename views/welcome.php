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
    <link rel="stylesheet" href="<?= DIR ?>static/css/style.css">
    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/c1d2775197.js" crossorigin="anonymous"></script>
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
        <div class="text-center headprint">
            <img class="m-3" src="<?= DIR ?>static/img/racelogos/1zFSchriftzugGeradeTraining_white-min.svg" alt="1zF" width-max="100%">
        </div>
    </header>
    <main>
        <div class="container">
            <p><?= Message::show() ?></p>
            <div class="text-center">
                <div class="card-group justify-content-center mt-5">
                    <div class="col-12 col-md-5 m-1">
                        <div class="card ">
                            <a style="color: black" href="<?= DIR ?>registration/index">
                                <div class="card-body">

                                    <span><i class="fas fa-clipboard-list fa-4x"></i></span>
                                    <div class="text-center">Anmeldung</div>

                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 m-1">
                        <div class="card">
                            <a style="color: black" class="" href="<?= DIR ?>athletes/rules">
                                <div class="card-body">

                                    <span><i class="fas fa-info fa-4x"></i></span>
                                    <div class="text-center">Infos</div>

                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 m-1">
                        <div class="card">
                            <a style="color: black" class="" href="<?= DIR ?>events/participants">
                                <div class="card-body">

                                    <span><i class='fas fa-list fa-4x'></i></span>
                                    <div class="text-center">Teilnehmer</div>

                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 m-1">
                        <div class="card">
                            <a style="color: black" class="" href="<?= DIR ?>events/results">
                                <div class="card-body">

                                    <span><i class='fas fa-medal fa-4x'></i></span>
                                    <div class="text-center">Ergebnisse</div>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <p><img class="headprint mt-5" src="<?= DIR ?>static/img/racelogos/winnerWheel_2021.png" alt="Siegertafel" width-max="100%"></p>
            </div>
        </div>
    </main>
    <footer></footer>
</body>

</html>