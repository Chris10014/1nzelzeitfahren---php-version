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
   <link rel="stylesheet" href="<?= URL::STYLES('style') ?>">
</head>

<body>
   <div class="text-center" id="headprint">
      <img src="<?= DIR ?>static/img/racelogos/1zFSchriftzugGeradeTraining_white-min.svg" alt="1zF" width-max="100%">
   </div>
   <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
      <div class="container-fluid">
         <a class="navbar-brand" href="<?= DIR ?>"></a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="<?= DIR ?>">Home</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="<?= DIR ?>registration/index">Anmeldung</a>
               </li>
               <li class=" nav-item">
                  <a class="nav-link" href="#">Ausschreibung</a>
               </li>
               <li class=" nav-item">
                  <a class="nav-link" href="#">Teilnehmerliste</a>
               </li>
               <li class=" nav-item">
                  <a class="nav-link" href="#">Egebnisse</a>
               </li>
            </ul>
         </div>
      </div>
   </nav>