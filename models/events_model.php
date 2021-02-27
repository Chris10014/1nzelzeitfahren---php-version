<?php

class Events_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function all() 
    {
        return $this->_db->select('SELECT * FROM events ORDER BY name DESC');
    }

    public function event($event_id = 1)
    {
        $prepared_sql = "SELECT * FROM events WHERE id = :eid LIMIT 1";
        $data = array(":eid" => $event_id);

        $res = $this->_db->select($prepared_sql, $data);
        if (count($res) == 1) {
            return $res[0];
        } else {
            return false;
        }
    }

    /**
     * Selects event dates where rgistration either is open (by default) or closed
     * 
     * @param  int $event_id  id of the event
     * @param  boolean optional: $reg_open 1 for open reg (default), 0 for closed reg
     * @return array of all event dates for an event which are either open or closed
     */
    public function eventDateWithRegistration($event_id, $reg_open = 1)
    {
        $prepared_sql = "SELECT * FROM event_dates WHERE event_id = :eid AND reg_open = :reg LIMIT 1";
        $data = array(":eid" => $event_id, ":reg" => $reg_open);

        $res = $this->_db->select($prepared_sql, $data);
        if (count($res) == 1) {
            return $res[0];
        } else {
            return false;
        }
    }

}

?>