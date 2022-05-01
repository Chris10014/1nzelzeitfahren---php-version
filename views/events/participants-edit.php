 <?php
    if (isset($_SESSION['oldEmail'])) {
        $oldEmail = htmlentities($_SESSION['oldEmail']);
    } else {
        $oldEmail = "";
    }
    ?>

 <header class="text-center">
     <div class="container">
         <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            ?>
             <div class="mb-4">
                 <?php
                    foreach (array_reverse($data["allEventDates"]) as $eventDate) {
                        echo "<a class='btn btn-light m-1 js-year-btn' role='button' href='";
                        echo DIR;
                        echo  "events/editResults/", $eventDate['id'], "'>";
                        echo  date("Y", strtotime($eventDate['date'])), "</a>";
                    }
                    ?>
             </div>
         <?php } ?>

         <h1>Ergebnisse eintragen</h1>
     </div><!-- / container -->
 </header>
 <main>
     <div class="container">
         <?php echo Message::show(); ?>
         <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            ?>
             <section>
                 <h2><?= $data['event']['name'] ?> am <?= Utils::convertDate($data['event']['date']) ?></h2>
                 <form method="POST" action="<?= DIR ?>events/updateResults/<?= $data['eventDateId'] ?> ">
                     <table class="table table-dark" id="participants">
                         <thead>
                             <tr>
                                 <th>Nr.</th>
                                 <th>Startzeit</th>
                                 <th>Planzeit</th>
                                 <th>Name</th>
                                 <th>AK</th>
                                 <th>Verein</th>
                                 <th>Brutto Zielzeit</th>
                             </tr>
                         </thead>
                         <tbody>

                             <?php
                                $gender = GENDER;
                                foreach ($data['participants'] as $part) {
                                    $userId = $part['user_id'];
                                    $ageGroup = Utils::ageGroup($data['event']['date'], $part['year_of_birth']);
                                    $number = $part['number'] ? $part['number'] : "tbd";
                                    $estimatedFinishTime = $part['estimated_finish_time'] ? $part['estimated_finish_time'] : "00:00:00";
                                    $bruttoFinishTime = $part['brutto_finish_time'];
                                    echo "
               

                <tr>
                <td>
                <input type='hidden' name='userId[]' id='userId' value='" . $userId . "'>
               
                <input type='number' class='form-control' name='number[]' id='number' value='" . $number . "'>
                </td> 
                <td>
                 <input type='time' class='form-control' step='1' name='startTime[]' id='startTime' placeholder='HH:MM:SS' value='" . $part['start_time'] . "'>  
                </td> 
                <td>"
                                        . $estimatedFinishTime . "
                </td>             
                <td>" . htmlentities($part['first_name']) . " " . htmlentities($part['last_name']) . "</td>
                <td>" . $part['gender'] . " " . $ageGroup . "</td>
                <td>" . htmlentities($part['team_name']) . "</td>
                <td>                           
                    <input type='time' class='form-control' step='1' name='bruttoFinishTime[]' id='bruttoFinishTime' placeholder='HH:MM:SS' value='" . $bruttoFinishTime . "'>  
                </td>
                </tr>
                
                ";
                                }

                                ?>

                         </tbody>
                     </table>
                     <p>
                     <div class='form-group'>
                         <div>
                             <input type='submit' class='col-md-auto btn btn-default' name='send' value='Speichern'>
                             &nbsp;
                             <input type='submit' class='col-md-auto btn btn-danger' name='cancel' value='Abbrechen' formnovalidate>
                         </div>
                     </div>
                     </p>
                 </form>
             </section>
             <?php
            } else { // input admin code

                if (isset($_SESSION['adminCodeCreated']) && $_SESSION['adminCodeCreated'] == 1) {

                ?>
                 <code>
                     <?php
                        if (SERVER !== null && SERVER == "test") {
                            echo $_SESSION['adminCode'];
                        } else {
                            "";
                        }
                        ?>
                 </code>
                 <p>Es wurde ein Admin Code an Deine E-Mail Adresse: <strong><?= $_SESSION['email']; ?></strong> gesendet.
                     Bitte gebe diesen Code in das untere Feld ein um zu de Adminseiten zu gelangen.</p>

                 <form method="POST" class="text-center" action="<?= DIR ?>events/validateAdminCode">
                     <input type='hidden' name='eventDateId' id='eventDateId' value='<?= $data['eventDateId'] ?>' />
                     <p>
                     <div class="form-group">
                         <div class="col-xs-2">
                             <label for="regCode">Code:</label>
                             <input type="text" class="form-control" pattern="[0-9]{6}" name="regCode" id="regCode" placeholder="Admin Code" value="">
                         </div>
                     </div>
                     </p>
                     <p>
                         <input type="submit" class="btn btn-default" name="send" value="Abschicken">
                         <input type="submit" class="btn btn-danger" name="cancel" value="Abbrechen">
                     </p>
                 </form>
             <?php
                } else { // input email address
                ?>
                 <p class="text-center">Bitte gib Deine E-Mail Adresse ein um Dich einzuloggen.</p>
                 <form method="POST" class="text-center" action="<?= DIR ?>events/isUserAdmin">
                     <input type='hidden' name='eventDateId' id='eventDateId' value='<?= $data['eventDateId'] ?>' />
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
                } // / input email address
            }
            ?>
     </div><!-- / container -->
 </main>
 <script>
     $(document).ready(function() {
         //collect all buttons for year selection in an array
         var buttons = document.getElementsByClassName("js-year-btn");

         //loop through the array and compare button href with the current url
         //set the button to outline == current url
         for (var i = 0; i < buttons.length; i++) {
             if (window.location.href == ($(buttons[i]).attr("href"))) {
                 $(buttons[i]).removeClass('btn-light');
                 $(buttons[i]).addClass('btn-outline-light');
             }
         }
     });
 </script>