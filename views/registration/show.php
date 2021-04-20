<?php

$ageGroup = Utils::ageGroup($data["registration"]["year_of_birth"]);

?>
<header>
    <div class="container">
        <h1>Deine Anmeldung</h1>
        <h1><?= $data["registration"]["event_name"] ?> am <?php echo Utils::convertDate($data['registration']["date"]); ?></h1>
    </div><!-- / container -->
</header>
<main>
    <div class="container">
        <p>Name: <?= $data["registration"]["first_name"] ?> <?= $data["registration"]["last_name"] ?></p>
        <p>Verein: <?= $data["registration"]["team_name"] ?></p>
        <?php
        if (isset($data["registration"]["support"])) {
            echo "<p>Helfer <i class='far fa-check-circle'></i></p>";
        } else {
            echo "<p>Helfer <i class='far fa-times-circle'></i></p>";
        }
        if (isset($data["registration"]["participant"])) {
            echo "<p>Fahrer <i class='far fa-check-circle'></i></p>";
            echo "<p>AK: " . $data["registration"]["gender"] . " " . $ageGroup . "</p>";
            echo "<p>geplante Zielzeit: " . $data["registration"]["estimated_finish_time"] . "</p>";
        } else {
            echo "<p>Fahrer <i class='far fa-times-circle'></i></p>";
        }
        ?>
        <p><a href="<?= DIR ?>events/participants/<?= $data['registration']['event_id'] ?>">zur Teilnehmerliste</a></p>
    </div><!-- / container -->
</main>