

<main>
    <!-- <header>
        <div class="text-center headprint">
            <img class="m-3" src="<?= DIR ?>static/img/racelogos/1zFSchriftzugGeradeTraining_white-min.svg" alt="1zF" width-max="100%">
        </div>
    </header> -->
    <div class="container">
        <div class="container">
            <p><?= Message::show() ?></p>
            <div class="text-center">
                <div class="card-group justify-content-center mt-5">
                    <div class="col-12 col-md-5 m-1">
                        <div class="card ">
                            <a style="color: black" href="<?= DIR ?>registration/index">
                                <div class="card-body">
                                    <span><i class="fas fa-clipboard-list fa-4x"></i></span>
                                    <div class="text-center">Anmeldung 
                                        <?php 
                                           if(isset($_SESSION['eventDate'])) {
                                            echo  "für " . Utils::convertDate($_SESSION["eventDate"]);
                                        } 
                                        ?>                                           
                                    </div>

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