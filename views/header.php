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
   <link rel="shortcut icon" href="<?= DIR ?>static/img/1zf_favicon.ico">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
   <link rel="stylesheet" href="<?= DIR ?>static/css/style.css">
   <!-- Font Awesome Kit -->
   <script src="https://kit.fontawesome.com/c1d2775197.js" crossorigin="anonymous"></script>
   <!-- JavaScript Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

   <!-- jQuery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css">
</head>


<body id="body">

   <div class="text-center headprint">
      <img class="m-3" src="<?= DIR ?>static/img/racelogos/1zFSchriftzugGeradeTraining_white-min.svg" alt="1zF" width-max="100%">
   </div>
   <div class="container">

      <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
         <div class="container-fluid">
            <a class="navbar-brand" href="<?= DIR ?>"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav mx-auto">
                  <li class="nav-item">
                     <a class="nav-link" aria-current="page" href="<?= DIR ?>">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="<?= DIR ?>registration/index">Anmeldung</a>
                  </li>
                  <li class=" nav-item">
                     <a class="nav-link" href="<?= DIR ?>athletes/rules">Ausschreibung</a>
                  </li>
                  <li class=" nav-item">
                     <?php

                     ?>
                     <a class="nav-link" href="<?= DIR ?>events/participants">Teilnehmerliste</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="<?= DIR ?>events/results">Ergebnisse</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" style="color:#343a40" href="<?= DIR ?>events/editResults">Admin</a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>

   </div>

   <script>
      $(document).ready(function() {
         var navItems = document.getElementsByClassName("nav-link");
         for (var i = 1; i < navItems.length; i++) { //start with 1 to exclude home url because it is part of all urls)
            if (window.location.href.indexOf($(navItems[i]).attr("href")) !== -1) {
               $(navItems[i]).addClass('active')
            }
         }
      });
   </script>