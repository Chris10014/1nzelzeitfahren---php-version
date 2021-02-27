<?php

class Event_dates_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function all() 
    {
        return $this->_db->select('SELECT * FROM event_dates ORDER BY date DESC');
    }

    /**
     * Selects all event dates for an event
     * 
     * @param  int $event_id  id of the event
     * @return array of all eventdates for an event
     */
    public function event($event_id)
    {
        $prepared_sql = "SELECT * FROM event_dates WHERE event_id = :eid LIMIT 1";
        $data = array(":eid" => $event_id);

        return $this->_db->select($prepared_sql, $data);
    }