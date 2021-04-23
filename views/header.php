<?php
session_start();
?>

<!DOCTYPE html>
<html lang="de">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= $data['title'] . ' - ' . SITETITLE ?></title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
   <link rel="stylesheet" href="<?= DIR ?>static/css/style.css">
   <!-- Font Awesome Kit -->
   <script src="https://kit.fontawesome.com/c1d2775197.js" crossorigin="anonymous"></script>
   <!-- JavaScript Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

   <!-- jQuery -->
   <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css">

   <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
   <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
   <script src="<?= DIR ?>static/js/1zf.js"></script>
</head>


<body id="body">
   <div class="text-center" id="headprint">
      <img src="<?= DIR ?>static/img/racelogos/1zFSchriftzugGeradeTraining_white-min.svg" alt="1zF" width-max="100%">
   </div>
   <div class="conrainer">

      <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
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
                  <li class=" nav-item">
                     <a class="nav-link" href="<?= DIR ?>events/editResults/1">Admin</a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>

   </div>