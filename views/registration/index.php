 <?php
    if (isset($_SESSION['oldEmail'])) {
        $oldEmail = htmlentities($_SESSION['oldEmail']);
    } else {
        $oldEmail = "";
    }
    ?>


 <header class="text-center">
     <div class="container">
         <h1>Anmeldung</h1>
         <?php
            if ($_SESSION["eventDate"] !== null) {
                echo "<h3>für den ";
                echo Utils::convertDate($_SESSION["eventDate"]);
                echo "</h3>";
            }
            ?>
     </div><!-- / container -->
 </header>
 <main>
     <div class="container">
         <?php echo Message::show(); ?>
         <?php

            if ($data['eventId'] !== null) {
                if (isset($_SESSION['regCodeCreated']) && $_SESSION['regCodeCreated'] == 1) {

            ?>
                 <code>
                     <?php
                        if (SERVER !== null && SERVER == "test") {
                            echo $_SESSION['regCode'];
                        } else {
                            "";
                        }
                        ?>
                 </code>
                 <p>Es wurde ein 4 stelliger Registrierungs Code an Deine E-Mail Adresse: <strong><?= $_SESSION['email']; ?></strong> gesendet.
                     Bitte gebe diesen Code in das untere Feld ein um die Anmeldung fortzusetzen. Wenn Du keinen Code erhalten hast, kannst Du den Vorgang abbrechen und wiederholen.
                     Prüfe auch ob die E-Mail im SPAM Ordner Deines Postfachs liegt.</p>

                 <form method="POST" class="text-center" action="<?= DIR ?>registration/validateRegCode">
                     <p>
                         <label for="regCode">Code:</label>
                         <input type="text" class="form-control" pattern="[0-9]{4}" name="regCode" id="regCode" placeholder="4 stelliger Code" value="">
                     </p>
                     <p>
                         <input type="submit" class="btn btn-default" name="send" value="Abschicken">
                         <input type="submit" class="btn btn-danger" name="cancel" value="Abbrechen">
                     </p>
                 </form>
             <?php
                } else {
                ?>
                 <p class="text-center">Bitte gib Deine E-Mail Adresse ein um zu prüfen, ob Du schon eine Einladung hast.</p>
                 <form method="POST" class="text-center" action="<?= DIR ?>registration/isEmailRegistered">
                     <p>
                         <label for="email">E-Mail:</label>
                         <input type="email" name="email" id="email" placeholder="E-Mail Adresse" value="<?= $oldEmail ?>">
                     </p>
                     <p>
                         <input type="submit" class="btn btn-default" name="send" value="Abschicken">
                         <input type="submit" class="btn btn-danger" name="cancel" value="Abbrechen" formnovalidate>
                     </p>
                 </form>
         <?php
                }
            } else {
                echo "<div class='text-center'>
                <h3>Zur Zeit ist die Anmeldung nicht geöffnet.</h3>
                </div>";
            }
            ?>
     </div><!-- / container -->
 </main>