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
    $participant = $_SESSION['oldRequest']['participant'] ?? "";
    $supporter = $_SESSION['oldRequest']['supporter'] ?? "";
} else {
    // Existing data from the database
    $firstName = htmlentities($data['user'][0]['first_name']) ?? "";
    $name = htmlentities($data['user'][0]['name']) ?? "";
    $yearOfBirth = htmlentities($data['user'][0]['year_of_birth']) ?? "";
    $team = htmlentities($data['team']['name']) ?? "";
    $participant = "";
    $supporter = "";
    $estFinishTime = "00:00:00";
}
$email = htmlentities($_SESSION['email']) ?? "";
$myGender = $data['user'][0]['gender'] ?? "";
$event = $data['event']['name'] ?? "Veranstaltung nicht gefunden.";
$date = $data['eventDate']['date'] ?? "";
if ($date != false && strlen($date) > 0) {
    $date = Utils::convertDate($data['eventDate']['date']);
} else {
    Message::set("Zur Zeit ist die Anmeldung nicht geöffnet.", "info");
    header("Location:" . DIR . "registration/index/" . $_SESSION['eventId']);
    return;
}

?>
<header>
    <h1>Anmeldung</h1>
    <p>
        <?= $event ?> am: <strong><?= $date ?></strong>
    </p>
</header>
<main>
    <?php echo Message::show(); ?>

    <form method="POST" action="<?= DIR ?>registration/update">
        <p>
            Ich will als
            <label for="participant"><strong>Fahrer:in</strong></label>
            <input type="checkbox" name="participant" id="participant" value="checked" <?= $participant ?>>
            und / oder als
            <label for="helper"><strong>Helfer:in</strong></label>
            <input type="checkbox" name="supporter" id="helper" value="checked" <?= $supporter ?>>
            teilnehmen.
        </p>
        <p>
            <label for="first_name">Vorname:</label>
            <input type="text" name="first_name" id="first_name"" placeholder=" Vorname" value="<?= $firstName ?>">
            <label for="name">Nachname:</label>
            <input type="text" name="name" id="name" placeholder="Nachname" value="<?= $name ?>">
        </p>
        <p>
            <label for="email">E-Mail:</label>
            <input type="email" name="email" id="email" placeholder="E-Mail Adresse" value="<?= $email ?>" disabled>
        </p>
        <p>
            <label for="team">Verein:</label>
            <input type="text" name="team" id="team" placeholder="Verein" value="<?= $team ?>">
        </p>
        <p>
            <label for="estFinishTime">geplante Zielzeit:</label>
            <input type="time" step="1" name="estFinishTime" id="estFinishTime" placeholder="HH:MM:SS" value="<?= $estFinishTime ?>">
        </p>
        <p>
            <?php
            $genderList = array("M", "W", "O");

            foreach ($genderList as $gender) {
                echo
                "<label for='" . $gender . "'>" . $gender . "</label>
                <input type='radio' name='gender' id='" . $gender . "'";
                if ($gender == $myGender) {
                    echo "checked";
                }
                echo ">";
            }
            ?>
        </p>
        <p>
            <label for="yearOfBirth">Jahrgang:</label>
            <input type="text" pattern="(?:19|20)[0-9]{2}" name="yearOfBirth" id="yearOfBirth" value="<?= $yearOfBirth ?>">
        </p>
        <p>
            <input type="checkbox" name="termsAndConditions" id="termsAndConditions" value="confirmed" required>
            <label for="termsAndConditions">Ich habe die <a href="<?= DIR ?>static/downloads/Verzichtserklärung und Haftungsfreistellung.pdf" target="_blank">Verzichtserklärung und Haftungsfreistellung</a> gelesen und akzeptiert.</label>
        </p>
        <p>
            <input type="checkbox" name="raceInfo" id="raceInfo" value="confirmed" required>
            <label for="raceInfo">Ich habe die <a href="<?= DIR ?>static/downloads/1zF_Infounterlage.pdf" target="_blank">Infounterlage</a> gelesen und bin insbesondere mit den Gefahrenhinweisen vertraut.</label>
        </p>
        <p>
            <input type="submit" class="btn btn-default" name="send" value="Weiter">
            <input type="submit" class="btn btn-danger" name="cancel" value="Abbrechen" formnovalidate>
        </p>
    </form>

</main>

</body>

</html>