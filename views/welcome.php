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
        <div class="text-center" id="headprint">
            <img src="<?= DIR ?>static/img/racelogos/1zFSchriftzugGeradeTraining_white-min.svg" alt="1zF" width-max="100%">
        </div>
        <!-- <nav class="navbar navbar-expand-lg navbar-dark">
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
                            <a class="nav-link" href="<?= DIR ?>registration/index">Anmeldung</a>
                        </li>
                        <li class=" nav-item">
                            <a class="nav-link" href="<?= DIR ?>athletes/rules">Ausschreibung</a>
                        </li>
                        <li class=" nav-item">
                            <a class="nav-link" href="<?= DIR ?>events/participants">Teilnehmerliste</a>
                        </li>
                        <li class=" nav-item">
                            <a class="nav-link" href="<?= DIR ?>events/results">Ergebnisse</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> -->
    </header>
    <main>
        <div class="container">
            <div class="text-center">
                <div class="row">
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
                            <a style="color: black"  class="" href="<?= DIR ?>events/results">
                                <div class="card-body">

                                    <span><i class='fas fa-medal fa-4x'></i></span>
                                    <div class="text-center">Ergebnisse</div>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <p><?= Message::show() ?></p>
            <p><img class="m-5" src="<?= DIR ?>static/img/racelogos/winnerWheel_2021.png" alt="Siegertafel"></p>
        </div>
    </main>
    <footer></footer>
</body>

</html>