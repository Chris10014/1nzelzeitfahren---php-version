 <?php
    if (isset($_SESSION['oldEmail'])) {
        $oldEmail = htmlentities($_SESSION['oldEmail']);
    } else {
        $oldEmail = "";
    }
    ?>


 <header class="text-center">
     <h1>Anmeldung</h1>
 </header>
 <main>
     <?php echo Message::show(); ?>
     <?php

        if (isset($_SESSION['regCodeCreated']) && $_SESSION['regCodeCreated'] == 1) {

        ?>
         <p>Es wurde ein 4 stelliger Registrierungs Code an Deine E-Mail Adresse: <strong><?= $_SESSION['email']; ?></strong> gesendet.
             Bitte gebe diesen Code in das untere Feld ein um die Anmeldung fortzusetzen. Wenn Du keinen Code erhalten hast, kann Du den Vorgang abbrechen und wiederholen.
             Prüfe auch ob die E-Mail im SPAM Ordner Deines Postfachs liegt.</p>

         <form method="POST" class="text-center" action="<?= DIR ?>registration/validateRegCode">
             <p>
                 <label for=" regCode">Code:</label>
                 <input type="text" pattern="[0-9]{4}" name="regCode" id="regCode" placeholder="4 stelliger Code" value="">
             </p>
             <p>
                 <input type="submit" class="btn btn-default" name="send" value="Abschicken">
                 <input type="submit" class="btn btn-danger" name="cancel" value="Abbrechen">
             </p>
         </form>
     <?php
        } else {
        ?>
         <p class="text-center">Bitte gib Deine E-Mail Adresse ein um zu prüfen, ob Du an der Veranstaltung teilnehmen darfst.</p>
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
        ?>
 </main>