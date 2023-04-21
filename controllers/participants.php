<?php

require('models/users_model.php');
require('models/events_model.php');
require('models/teams_model.php');
require('models/users_have_events_model.php');

class Participants extends Controller
{
    public function __construct()
    {
        parent::__construct();       
    }

    public function index($event_id) 
    {
        
    }
}