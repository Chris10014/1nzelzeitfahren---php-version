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



                    if (SERVER !== null && SERVER == "test") {
                        echo "<code>" . $_SESSION['regCode'] . "</code>";
                    } else {
                        "";
                    }
                    if (
                        stripos($_SESSION['email'], "@web.de") ||
                        stripos($_SESSION['email'], "@gmx.de")
                    ) {
                        echo "<p>Bitte gib den Code <strong>" . $_SESSION['regCode'] . "</strong> in das untere Feld ein.</p>";
                    } else {
            ?>
                     <p>Es wurde ein 4 stelliger Registrierungs Code an Deine E-Mail Adresse: <strong><?= $_SESSION['email']; ?></strong> gesendet.
                         Bitte gebe diesen Code in das untere Feld ein um die Anmeldung fortzusetzen. Wenn Du keinen Code erhalten hast, kannst Du den Vorgang abbrechen und wiederholen.
                         Prüfe auch ob die E-Mail im SPAM Ordner Deines Postfachs liegt.</p>

                 <?php
                    }
                    ?>

                 <form method="POST" class="text-center" action="<?= DIR ?>registration/validateRegCode">
                     <div class="form-group row">
                         <label class="col-md-1 col-form-label" for=" regCode">Code:</label>
                         <input type="text" class="col-10 col-md-6 form-control" pattern="[0-9]{4}" name="regCode" id="regCode" placeholder="4 stelliger Code" value="">
                     </div>
                     <div class="offset-1 form-group row">
                         <input type="submit" class="col-md-auto btn btn-default" name="send" value="Abschicken">
                         &nbsp&nbsp
                         <input type="submit" class="col-md-auto btn btn-danger" name="cancel" value="Abbrechen" formnovalidate>
                     </div>
                 </form>
             <?php
                } else {
                ?>
                 <p class="">Bitte gib Deine E-Mail Adresse ein um zu prüfen, ob Du schon eine Einladung hast.</p>
                 <form method="POST" class="" action="<?= DIR ?>registration/isEmailRegistered">
                     <div class="form-group row">
                         <label class="col-md-1 col-form-label" for=" email">E-Mail:</label>
                         <input type="email" class="col-10 col-md-8 form-control" name="email" id="email" placeholder="E-Mail Adresse" value="<?= $oldEmail ?>">
                     </div>
                     <div class="offset-1 form-group row">
                         <input type="submit" class="col-md-auto btn btn-default"" name=" send" value="Abschicken">
                         &nbsp&nbsp
                         <input type="submit" class="col-md-auto btn btn-danger" name="cancel" value="Abbrechen" formnovalidate>
                     </div>
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