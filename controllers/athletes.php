<?php
require('models/events_model.php');

class Athletes extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    }
    
    public function rules()
    {

        $newEvent = new Events_Model();
        $event = $newEvent->regOpen(); //find event with active registration phase
        if ($event !== null ) {           
                $_SESSION['eventId'] = $event["event_id"];
                $_SESSION['eventDate'] = $event["date"];
        } else {
            $_SESSION['eventId'] = null;
            $_SESSION['eventDate'] = null;
        }

        $data['title'] = 'Regeln';

        $this->_view->render('header', $data);
        $this->_view->render('athletes/rules');
        $this->_view->render('footer');
    }

    public function privacy()
    {
        $data['title'] = 'Datenschutz';

        $this->_view->render('header', $data);
        $this->_view->render('athletes/privacy');
        $this->_view->render('footer');
    }

    public function contact()
    {
        $data['title'] = 'Kontakt';

        $this->_view->render('header', $data);
        $this->_view->render('athletes/contact');
        $this->_view->render('footer');
    }

    public function certificate() {

        $data['title'] = 'Urkunde';

        $data['lastName'] = $_GET['lastName'];
        $data['firstName'] = $_GET['firstName'];
        $data['team'] = $_GET['team'];
        $data['time'] = date("H", strtotime($_GET['time'])) . "h "
        . date("i", strtotime($_GET['time'])) . "m "
        . date("s", strtotime($_GET['time'])) . "s";
        $data['rank'] = $_GET['rank'];
        switch ($_GET['gender']) {
            case "W":
                $data['gender'] = "Frauen";
                break;
            case "M":
                $data['gender'] = "Männer";
                break;
            case "D":
                $data['gender'] = "Divers";
                break;

            default:
                $data['gender'] = "";
        } 
        $data['date'] = $_GET['date'];

        if(isset($_GET['teamCompetition']) && $_GET['teamCompetition'] == 1) {
            $data['teamCompetition'] = $_GET['teamCompetition']; 
        } else {
             $data['teamCompetition'] = "";
        }
    
        $this->_view->render('athletes/certificate', $data);      
    }
}