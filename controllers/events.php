<?php

require('models/users_model.php');
require('models/teams_model.php');
require('models/users_have_events_model.php');
require('models/users_have_roles_model.php');

class Events extends Controller
{
    public function __construct()
    {
        parent::__construct();       
    }

    public function index()
    {
       
        $data['title'] = 'Events';
        $data['events'] = $this->_model->all();
       

        $this->_view->render('header', $data);
        $this->_view->render('events/index', $data);
        $this->_view->render('footer');
    }

    public function participants($event_date_id)
    {
        $data['title'] = 'Teilnehmer';
        $data['event'] = $this->_model->event($event_date_id);
        $data['participants'] = $this->_model->participants($event_date_id);
        $data['participantsM'] = $this->_model->participants($event_date_id, "M");
        $data['participantsW'] = $this->_model->participants($event_date_id, "W");
        $data['participantsD'] = $this->_model->participants($event_date_id, "D");
        $data['supporter'] = $this->_model->supporter($event_date_id);

        $this->_view->render('header', $data);
        $this->_view->render('events/participants', $data);
        $this->_view->render('footer');
    }

    public function editResults($event_date_id)
    {
        $data['title'] = 'Ergebnisse eintragen';
        $data['event'] = $this->_model->event($event_date_id);
        $data['participants'] = $this->_model->participants($event_date_id);
        $data['participantsM'] = $this->_model->participants($event_date_id, "M");
        $data['participantsW'] = $this->_model->participants($event_date_id, "W");
        $data['participantsD'] = $this->_model->participants($event_date_id, "D");

        $this->_view->render('header', $data);
        $this->_view->render('events/participants-edit', $data);
        $this->_view->render('footer');

    }

    /**
     * Update the number, starting time and results of User have events
     * @param int $event_date_id the unique id of an event date
     * @return writes the data into the db and returns to the events.result view 
     */
    public function updateResults($event_date_id)
    {
        if (isset($_POST['cancel'])) {
            session_destroy();
        }
        $arrayLength = count($_REQUEST['userId']);

        // validate start numbers
        $numbers_validated = array_unique($_REQUEST['number']); // remove duplicate values from array
        
        If($numbers_validated != $_REQUEST['number']) {// has array changed
            Message::set('Startnummern enthalten Dubletten.', 'warning');
            header("Location: " . DIR . "events/editResults/1");
            return;
        }

        $startTimes_validated = array_unique($_REQUEST['startTime']); // remove duplicate values from array
        if ($startTimes_validated != $_REQUEST['startTime']) {// has array changed
            Message::set('Startzeiten enthalten Dubletten.', 'warning');
            header("Location: " . DIR . "events/editResults/1");
            return;
        }

        if (count($_REQUEST['startTime']) == $arrayLength && count($_REQUEST['number']) == $arrayLength && count($_REQUEST['bruttoFinishTime']) == $arrayLength) { // all array have the same number of items
            for ($i = 0; $i < $arrayLength; $i++) {
                $user_id = $_REQUEST['userId'][$i];
                $start_time = $_REQUEST['startTime'][$i];
                $number = $_REQUEST['number'][$i];
                $brutto_finish_time = $_REQUEST['bruttoFinishTime'][$i];

                if (strtotime($brutto_finish_time) > strtotime($start_time)) {
                    $time = strtotime($brutto_finish_time) - strtotime($start_time);
                    $netto_finish_time = gmdate("H:i:s", $time);
                } else {
                    $netto_finish_time = "-/-";
                }

                // Update user have events
                $data = array(
                    "number" => $number,
                    "start_time" => $start_time,
                    "brutto_finish_time" => $brutto_finish_time,
                    "netto_finish_time" => $netto_finish_time
                );
                $where = array("user_id" => $user_id, "event_date_id" => $event_date_id);

                $newUserHaveEvent = new Users_have_events_Model();
                $newUserHaveEvent->updateColumns($data, $where);
            } // / for loop
            session_destroy(); // logout admin

            header("Location:" . DIR . "/events/results/" . $event_date_id);
            return;
        } else { // the number of items in the arrays is not consistent
            echo "Data not consistent ...";
        }
    }

    public function results($event_date_id)
    {
        if (isset($_POST['cancel'])) {           
            session_destroy();           
        }
       
        $data['title'] = 'Ergebnisse';
        $data['event'] = $this->_model->event($event_date_id);
        $data['resultsM'] = $this->_model->results($event_date_id, "M");
        $data['resultsW'] = $this->_model->results($event_date_id, "W");
        $data['resultsD'] = $this->_model->results($event_date_id, "D");
        $data['supporter'] = $this->_model->supporter($event_date_id);
        $data['teamNames'] = $this->_model->teamNames($event_date_id);

        $this->_view->render('header', $data);
        $this->_view->render('events/results', $data);
        $this->_view->render('footer');
    }

    public function resultsPerTeam($event_date_id, $team_name = "%")
    {
        $data['title'] = 'Ergebnisse';
        $data['event'] = $this->_model->event($event_date_id);
        $data['resultsM'] = $this->_model->results($event_date_id, "M", $team_name);
        $data['resultsW'] = $this->_model->results($event_date_id,"W", $team_name);
        $data['resultsD'] = $this->_model->results($event_date_id,"D", $team_name);
        $data['teamNames'] = $this->_model->teamNames($event_date_id);
        $data['gender'] = GENDER;

        if(count($data['resultsM']) == 0 && count($data['resultsW']) == 0 && count($data['resultsD']) == 0){
            echo false;
        } else {
            echo json_encode($data);
        }
    }

    public function isUserAdmin() {
        // If canceled, start creation process again
        
        if (isset($_POST['cancel'])) {           
            session_destroy();
            header("Location: " . DIR);
            return;
        }

        if (isset($_POST['email']) && strlen($_POST['email']) > 0) {
            $_SESSION['oldEmail'] = $_POST['email'];

            if (strpos($_POST['email'], '@') === false || strlen($_POST['email']) < 6) {// email validation
                Message::set('Bitte eine richtige E-Mail Adresse eingeben.', 'warning');
                header("Location:" . DIR . "events/editResults/1");
                return;
            }
            
            // proceed checking if email is in the database
            // $user = new Users_Model();
            $row = (new Users_Model())->findByEmail($_POST['email']);
            if (count($row) == 0) {
                Message::set('E-Mail Adresse nicht bekannt.', 'warning');
                header("Location: " . DIR . "events/editResults/1");
                return;
            } else {                
                $_SESSION['userId'] = $row[0]['id'];
                $_SESSION['email'] = htmlentities($row[0]['email']);
               
                // check role
                $admin = (new Users_have_roles_Model())->checkRoleAdmin($_SESSION['userId']);
               
                if($admin !== true) {                    
                    Message::set('Du bist kein Admin.', 'warning');
                    header("Location: " . DIR . "events/editResults/1");
                    return;
                }

                $regCode = rand(100000, 999999);

                $hashedRegCode = hash('md5', $regCode);

                $res = self::updateRegCode($hashedRegCode);

                if ($res !== 1) {
                    Message::set("Admin Code konnte nicht erzeugt werden", "danger");
                    header("Location:" . DIR . "events/editResults/1");
                    return;
                }

                $_SESSION['adminCodeCreated'] = 1;
                // todo: send email with regCode
                $_SESSION['adminCode'] = $regCode; // for test only
               
                $txt = "Dein Admincode für 1nzelzeitfahren (Training): <strong>" . $regCode . "</strong>";
                Utils::sendMail($_SESSION["email"], $txt);
                
                header("Location: " . DIR . "events/editResults/1");
                return;
            }
        } else {
            Message::set('Bitte eine E-Mail Adresse eingeben.', 'warning');
            header("Location: " . DIR . "events/editResults/1");
            return;
        }
    }

    public function validateAdminCode()
    {
        // If canceld, start creation process again
        if (isset($_POST['cancel'])) {
            unset($_SESSION['adminCodeCreated']);
            // Delete reg code
            self::updateRegCode(NULL);

            header("Location: " . DIR);
            return;
        }
        // Validate entered reg code
        if (isset($_POST['regCode']) && is_numeric($_POST['regCode']) && strlen($_POST['regCode']) == 6) {
            // Check regCode and email in database
            $res = (new Users_Model())->findByRegCode($_POST['regCode']);
            // No results found
            if (count($res) == 0) {
                Message::set("Falscher Registrierungscode.", "warning");
                header("Location: " . DIR . "events/editResults/1");
                return;
            }
            // Open the door as admin
            $_SESSION['admin'] = 1;
            unset($_SESSION['adminCodeCreated']);
            // Delete admin code
            self::updateRegCode(NULL);

            header("Location:" . DIR . "events/editResults/1");
            return;
        } else {
            Message::set("Ungültiger Admincode.", "warning");
            header("Location: " . DIR . "events/editResults/1" );
            return;
        }
    }

    public static function updateRegCode($hashedRegCode)
    {//regCode == adminCode
        $data = ["reg_code" => $hashedRegCode];
        $where = ["id" => $_SESSION['userId'], "email" => $_SESSION['email']];

        return (new Users_Model())->updateColumns($data, $where);
    }

}