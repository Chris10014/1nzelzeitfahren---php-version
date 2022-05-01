<?php
require('models/events_model.php');

class Welcome extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index() 
    {

        $newEvent = new Events_Model();
        $event = $newEvent->regOpen(); //find event with active registration phase
        if ($event !== null) {
           
                $_SESSION['eventId'] = $event["event_id"];
                $_SESSION['eventDate'] = $event["date"];
            
        } else {
            $_SESSION['eventId'] = null;
            $_SESSION['eventDate'] = null;
        }


        $this->_view->render('header');
        $this->_view->render('welcome');
        $this->_view->render('footer');

    }

}
?>