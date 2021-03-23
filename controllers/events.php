<?php

require('models/users_model.php');
require('models/teams_model.php');
require('models/users_have_events_model.php');

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

    public function results($event_date_id)
    {
        $data['title'] = 'Teilnehmer';
        $data['event'] = $this->_model->event($event_date_id);
        $data['resultsM'] = $this->_model->results($event_date_id, "M");
        $data['resultsW'] = $this->_model->results($event_date_id, "W");
        $data['resultsD'] = $this->_model->results($event_date_id, "D");
        $data['supporter'] = $this->_model->supporter($event_date_id);

        $this->_view->render('header', $data);
        $this->_view->render('events/results', $data);
        $this->_view->render('footer');
    }

}