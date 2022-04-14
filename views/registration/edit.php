<?php
if (!isset($_SESSION['registrationValid']) || $_SESSION['registrationValid'] !== 1) {
    Message::set("Anmeldung nicht möglich", "danger");
    header("Location:" . DIR . "registration/index");
    return;
}

if ($_SESSION['oldRequest']) {
    // Already submitted data
    $firstName = htmlentities($_SESSION['oldRequest']['first_name']);
    $name = htmlentities($_SESSION['oldRequest']['name']);
    $yearOfBirth = htmlentities($_SESSION['oldRequest']['yearOfBirth']);
    $team =  htmlentities($_SESSION['oldRequest']['team']);
    $participant = $_SESSION['oldRequest']['participant'] ? $_SESSION['oldRequest']['participant'] : "";
    $support = $_SESSION['oldRequest']['support'] ?  $_SESSION['oldRequest']['support'] : "";
} else {
    // Existing data from the database
    $firstName = $data['user'][0]['first_name'] ? htmlentities($data['user'][0]['first_name']) : "";
    $name = ($data['user'][0]['name']) ? htmlentities($data['user'][0]['name']) : "";
    $yearOfBirth = ($data['user'][0]['year_of_birth']) ? htmlentities($data['user'][0]['year_of_birth']) : "";
    $team = ($data['team']['name']) ? htmlentities($data['team']['name']) : "";
    $participant = "";
    $support = "";
    $estFinishTime = "00:00:00";
}
$email = ($_SESSION['email']) ? htmlentities($_SESSION['email']) : "";
$myGender = $data['user'][0]['gender'] ? $data['user'][0]['gender'] : "";
$event = $data['event']['name'] ? $data['event']['name'] : "Veranstaltung nicht gefunden.";
$date = $data['eventDate']['date'] ? $data['eventDate']['date'] : "";
if ($date != false && strlen($date) > 0) {
    $date = Utils::convertDate($data['eventDate']['date']);
} else {
    Message::set("Zur Zeit ist die Anmeldung nicht geöffnet.", "info");
    header("Location:" . DIR . "registration/index/" . $_SESSION['eventId']);
    return;
}

?>
<header>
    <div class="container">
        <h1>Anmeldung</h1>
        <p>
            <?= $event ?> am: <strong><?= $date ?></strong>
        </p>
    </div><!-- / container -->
</header>
<main>
    <div class="container">


        <?php echo Message::show(); ?>

        <form method="POST" action="<?= DIR ?>registration/update">
            <p>
                Teilnehmen als:
            </p>
            <p>
            <div class="form-check">
                <input type="checkbox" class="form-check-input check" name="participant" id="participant" value="checked" <?= $participant ?>>
                <label class="form-check-label" for="participant">
                    <strong>Fahrer:in</strong>
                </label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input check" name="support" id="support" value="checked" <?= $support ?>>
                <label class="form-check-label" for="support">
                    <strong>Helfer:in</strong>
                </label>
            </div>
            </p>
            <p>
            <div class="form-group row">
                <label for="first_name" class="col-md-2 col-form-label">Vorname:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="first_name" id="first_name"" placeholder=" Vorname" value="<?= $firstName ?>">
                </div>
                <label for="name" class="col-md-2 col-form-label">Nachname:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nachname" value="<?= $name ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-md-2 col-form-label">E-Mail:</label>
                <div class="col-md-10">
                    <input type="email" class="form-control-plaintext" style="color: #FFFFFF" name="email" id="email" placeholder="E-Mail Adresse" value="<?= $email ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="team" class="col-md-2 col-form-label">Verein:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="team" id="team" placeholder="Verein" value="<?= $team ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="estFinishTime" class="col-md-2 col-form-label">geplante Zielzeit:</label>
                <div class="col-md-2">
                    <input type="time" class="form-control" step="1" name="estFinishTime" id="estFinishTime" placeholder="HH:MM:SS" value="<?= $estFinishTime ?>">
                </div>
            </div>
            <p>
                <?php
                $genderList = array("M", "W", "D");

                foreach ($genderList as $gender) {
                    echo
                    "<label for='" . $gender . "'>" . $gender;
                    if ($gender == 'M') {
                        echo " <i class='fas fa-mars'></i>";
                    } elseif ($gender == 'W') {
                        echo " <i class='fas fa-venus'></i>";
                    } else {
                        echo "<i class='fas fa-transgender'></i>";
                    }
                    echo "</label>
                <input type='radio' name='gender' id='" . $gender . "' value='" . $gender . "'";
                    if ($gender == $myGender) {
                        echo "checked";
                    }
                    echo " required>&nbsp &nbsp";
                }
                ?>
            <div class="form-group row">
                <label for="yearOfBirth" class="col-md-2 col-form-label">Jahrgang:</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" pattern="(?:19|20)[0-9]{2}" name="yearOfBirth" id="yearOfBirth" placeholder="1999" value="<?= $yearOfBirth ?>">
                </div>
            </div>
            </p>
            <p>
            <div class="form-check">

                <input type="checkbox" class="form-check-input" name="termsAndConditions" id="termsAndConditions" value="confirmed" required>
                <label for="termsAndConditions" class="col-md-12 form-check-label">
                    Ich habe die <a href="<?= DIR ?>static/downloads/Verzichtserklärung und Haftungsfreistellung.pdf" target="_blank">Verzichtserklärung und Haftungsfreistellung</a> gelesen und akzeptiert.
                </label>
            </div>
            <div class="form-check">

                <input type="checkbox" class="form-check-input" name="raceInfo" id="raceInfo" value="confirmed" required>
                <label for="raceInfo" class="col-md-12 form-check-label">
                    Ich habe die <a href="<?= DIR ?>static/downloads/1zF_Infounterlage.pdf" target="_blank">Infounterlage</a> gelesen und bin mit den Gefahrenhinweisen vertraut.
                    <p>Ich bin damit einverstanden, dass die von mir zu Anmeldung angegeben Daten gespeichert werden.
                        Sie werden alleine zur Durchführung, Auswertung und Ergebnisdarstellung des Einzelzeitfahren Training genutzt. In diesem Rahmen werden Namen und erreichte Zeit veröffentlicht.
                        Es werden keine Daten an Dritte weitergegeben.</p>
                </label>
            </div>
            </p>
            <p>
            <div class="form-group">
                <div>
                    <input type="submit" class="col-md-auto btn btn-default" name="send" value="Weiter">
                    &nbsp;
                    <input type="submit" class="col-md-auto btn btn-danger" name="cancel" value="Abbrechen" formnovalidate>
                </div>
            </div>
            </p>
        </form>
    </div><!-- / conatiner -->
</main>

<script>
    // autocomplete for team field
    $(document).ready(function() {
        $('#team').autocomplete({
            source: "<?= DIR ?>registration/autocompleteForTeams"
        });
    });
</script>