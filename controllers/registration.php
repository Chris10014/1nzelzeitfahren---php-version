<?php
require('models/users_model.php');
require('models/events_model.php');
require('models/teams_model.php');
require('models/users_have_events_model.php');

class Registration extends Controller
{
    public function __construct()
    {
        parent::__construct();       
    }

    public function index() 
    {
        $newEvent = new Events_Model();
        $event = $newEvent->regOpen(); //find event with active registration phase
        if($event !== null) {
            $_SESSION['eventId'] = $event["event_id"];
            $_SESSION['eventDate'] = $event["date"];
            $data['eventId'] = $event["id"];
        } else {
            $data['eventId'] = null;
            $_SESSION['eventId'] = null;
            $_SESSION['eventDate'] = null;
        }

        $data['title'] = "Anmeldung";
        $this->_view->render('header', $data);
        $this->_view->render('registration/index', $data);
        $this->_view->render('footer');
        

    }

    public function create()
    {
        echo "create registration controller";
    }

    public function store($request)
    {
        echo "store registration controller";
    }

    public function show($userId, $eventDateId)
    {
        $newUser = new Users_Model();
        $reg = $newUser->registration($userId, $eventDateId);

        $date['title'] = "Anmeldung";
        $data['registration'] = $reg;

        $this->_view->render('header', $data);
        $this->_view->render('registration/show', $data);
        $this->_view->render('footer');
    }
   
    public function edit($user_id, $event_id)
    {
        if (isset($_POST['cancel'])) {
            header("Location:" . DIR);
        }

        $newUser = new Users_Model();
        $newEvent = new Events_Model();
       
        $user = $newUser->findById($user_id);
        $team = $newUser->team($user_id);
        $date = $newEvent->eventDateWithRegistration($event_id);
        $event = $newEvent->event($event_id);
      
        if(count($newUser->registration($_SESSION['userId'], $date['id'])) > 0) {
            
            Message::set("Du bist schon angemeldet.", "info");           
            header("Location:" . DIR . "registration/index/" . $_SESSION['eventId']);
            return;
        }

        $data['title'] = "Anmeldung";
        $data['user'] = $user;
        $data['team'] = $team;
        $data['event'] = $event;
        $data['eventDate'] = $date;
        $_SESSION['eventDateId'] = $date['id'];

        $this->_view->render('header', $data);
        $this->_view->render('registration/edit', $data);
        $this->_view->render('footer');
    }

    /**
     * update method
     * @param  array $data  array of columns and values
     * @param  array $where array of columns and values
     */
    public function update()
    {
        if (isset($_POST['cancel'])) {
            if(isset($_SESSION['oldRequest'])) {
                unset($_SESSION['oldRequest']);
            };
            header("Location:" . DIR);
            return;
        }

        $_SESSION['oldRequest'] = $_REQUEST;
       
        $data = self::validateRegData($_REQUEST);

        if($data == false) {
            header("Location: " . DIR . "registration/edit/" . $_SESSION['userId'] . "/" . $_SESSION['eventId']);
            return;
        }

        // Find team id
        if (isset($_REQUEST['team']) && strlen($_REQUEST['team']) > 0) {

            $newTeam = new Teams_Model();
            $team = $newTeam->getTeamByName($_REQUEST['team']);
            if ($team !== false) {
                $teamId = $team['id'];
            } else {
                $teamId = $newTeam->insert($_REQUEST['team']);
            }
        } else {
            $teamId = NULL;
        }
       
        // Update user
        $data = array(
            "first_name" => $_REQUEST['first_name'],
            "name" => $_REQUEST['name'],
            "gender" => $_REQUEST['gender'],
            "hide_last_name" => $_REQUEST['hide_last_name'] ? 1 : "",
            "year_of_birth" => $_REQUEST['yearOfBirth'],
            "team_id" => $teamId,
        );

        $where = array("id" => $_SESSION['userId']);
        
        $newUser = new Users_Model();
        $newUser->updateColumns($data, $where);

        // insert event
        $data = [];
        if (isset($_REQUEST['participant'])) {
            $data["estimated_finish_time"] = $_REQUEST['estFinishTime'];
            $data["participant"] = 1;
        }
        if (isset($_REQUEST['support'])) {
            $data["support"] = 1;
        }
        $data["user_id"] = $_SESSION['userId'];
        $data["event_date_id"] = $_SESSION['eventDateId'];
        $data["for_team_id"] = $teamId;
        $data["confirmed_terms_and_conditions_at"] = date("Y-m-d H:i:s");
       
        $newActivity = new Users_have_events_Model();
        $activity = $newActivity->insert($data);
        
        if(isset($activity)) {
            unset($_SESSION['oldRequest']);            
            header("Location:" . DIR . "registration/show/" . $_SESSION["userId"] . "/" .  $_SESSION['eventDateId']);
            return;
        } else {
            Message::set("Etwas ging schief.", "danger");
            session_destroy();
            header("Location:" . DIR);
            return;
        }
        
    }

    public function destroy($id)
    {
        echo "destroy registration: " . $id . " controller";
    }

    /**
     * Function to check if the entered email address is on the list of invited participants
     * returns true and sends an email with reg code
     * returns false and redirect to main page with a message
     */
    public function isEmailRegistered()
    {
        // If canceld, start creation process again
        if (isset($_POST['cancel'])) {
           session_destroy();
            header("Location: " . DIR);
            return;
        }
        if (isset($_POST['email']) && strlen($_POST['email']) > 0) {
            $_SESSION['oldEmail'] = $_POST['email'];

            if (strpos($_POST['email'], '@') === false || strlen($_POST['email']) < 6) {
                Message::set('Bitte eine richtige E-Mail Adresse eingeben.', 'warning');
                header("Location:" . DIR . "registration/index/" . $_SESSION['eventId']);
                return;
            }

            // proceed checking if email is in the database
            // $user = new Users_Model();
            $row = (new Users_Model())->findByEmail($_POST['email']);
            if (count($row) == 0) {
                Message::set('Das tut uns leid, Du bist nicht berechtigt am 1zF Training teilzunehmen. Oder überprüfe Deine E-Mail Adresse auf mögliche Tippfehler.', 'warning');
                header("Location: " . DIR ."registration/index/" . $_SESSION['eventId']);
                return;
            } else {
                $_SESSION['userId'] = $row[0]['id'];
                $_SESSION['email'] = htmlentities($row[0]['email']);
                $regCode = rand(1000, 9999);
                
                $hashedRegCode = hash('md5', $regCode);

                $res = self::updateRegCode($hashedRegCode);

                if ($res !== 1) {
                    Message::set("Reg Code konnte nicht erzeugt werden", "danger");
                    header("Location:" . DIR ."registration/index/" . $_SESSION['eventId']);
                    return;
                }

                $_SESSION['regCodeCreated'] = 1;
                // todo: send email with regCode
                $_SESSION['regCode'] = $regCode; // for test only

                $txt = "Dein Registrierungscode für die Anmeldung zum 1nzelzeitfahren (Training): <strong>" . $regCode . "</strong>";
                Utils::sendMail($_SESSION["email"], $txt);

                header("Location: " . DIR ."registration/index/" . $_SESSION['eventId']);
                return;
            }
        } else {
            Message::set('Bitte eine E-Mail Adresse eingeben.', 'warning');
            header("Location: " . DIR ."registration/index/" . $_SESSION['eventId']);
            return;
        }
    }

    public function validateRegCode() 
    {
        // If canceld, start creation process again
        if (isset($_POST['cancel'])) {
            unset($_SESSION['regCodeCreated']);
            // Delete reg code
            self::updateRegCode(NULL);

            header("Location: " . DIR);
            return;
        }
        // Validate entered reg code
        if(isset($_POST['regCode']) && is_numeric($_POST['regCode']) && strlen($_POST['regCode']) == 4) {
            // Check regCode and email in database
            $res = (new Users_Model())->findByRegCode($_POST['regCode']);
            // No results found
            if(count($res) == 0){
                Message::set("Falscher Registrierungscode.", "warning");
                header("Location: " . DIR . "registration/index/". $_SESSION['eventId']);
                return;
            }
            // Redirect to registration form
            $_SESSION['registrationValid'] = 1;
            unset($_SESSION['regCodeCreated']);
            // Delete reg code
            self::updateRegCode(NULL);

            header("Location:" . DIR . "registration/edit/" . $_SESSION['userId'] . "/" . $_SESSION['eventId']);
            return;
        } else {
            Message::set("Ungültiger Registrierungscode.", "warning");
            header("Location: " . DIR ."registration/index/" . $_SESSION['eventId']);
            return;
        }
    }

    public function updateRegCode($hashedRegCode)
    {
        $data = ["reg_code" => $hashedRegCode];
        $where = ["id" => $_SESSION['userId'], "email" => $_SESSION['email']];

        return (new Users_Model())->updateColumns($data, $where);
    }

    public function validateRegData($data) 
    {
        
        if (!isset($data['participant']) && !isset($data['support'])) {
            Message::set('Bitte gebe an ob Du als Fahrer:in und / oder als Helfer:in mitmachen möchtest.', 'warning');
            return false;
        }
        if(!isset($data['first_name']) || strlen($data['first_name']) < 1) {
            Message::set('Bitte Vorname eingeben', 'warning');
            return false;
        } 
        if (!isset($data['name']) || strlen($data['name']) < 1) {
            Message::set('Bitte Nachname eingeben', 'warning');
            return false;
        }
        // if (isset($data['team']) && preg_match("([a-zA-Z0-9-.:&#\s])", $data['team']) !== 1) {
        //     Message::set('Bitte nur a-Z, 0-9 .:()- für Team verwenden', 'warning');
        //     return false;
        // } 
        if (!isset($data['yearOfBirth']) || !is_numeric($data['yearOfBirth'])) {
            Message::set('Bitte Jahrgang eintragen', 'warning');
            return false;
        } elseif (!isset($data['termsAndConditions']) || $data['termsAndConditions'] != "confirmed") {
            Message::set('Bitte Verzichtserklärung und Haftungsfreistellung akzeptieren.', 'warning');
            return false;
        } 
        if (!isset($data['raceInfo']) || $data['raceInfo'] != "confirmed") {
            Message::set('Bitte bestätige, dass Du die Infounterlage gelesen hast.', 'warning');
            return false;
        }         
        return $data;
    }

    /**
     * generate an array with team names for jQuers autocomplete
     * @param str search string from input field #team
     * @return echo array() with team names
     */

    public static function autocompleteForTeams()
    {
        $res = (new Teams_Model())->searchTeams($_REQUEST['term']);
        $teamNames = array();
        foreach ($res as $team) {
            $teamNames[] = $team['name'];
        }
        echo (json_encode($teamNames, JSON_PRETTY_PRINT));
    }
}