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

    public function regOpen()
    {
        $prepared_sql = "SELECT * FROM events JOIN event_dates ON events.id = event_dates.event_id 
        WHERE event_dates.reg_open = :regOpen LIMIT 1";
        $data = array(":regOpen" => 1);

        $res = $this->_db->select($prepared_sql, $data);
        if (count($res) == 1) {
            return $res[0];
        } else {
            return false;
        }
    }

    public function event($event_date_id)
    {
        $prepared_sql = "SELECT * FROM event_dates JOIN events ON events.id = event_dates.event_id 
        WHERE event_dates.id = :edid LIMIT 1";
        $data = array(":edid" => $event_date_id);

        $res = $this->_db->select($prepared_sql, $data);
        if (count($res) == 1) {
            return $res[0];
        } else {
            return false;
        }
    }

    /**
     * Selects event dates where registration either is open (by default) or closed
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

    /**
     * Selects participants of an event date
     * 
     * @param  int $event_date_id  id of the event date 
     * @param str $gender optional M, W, O  default: all
     * @return array of all participants ordered by last name
     */
    public function participants($event_date_id, $gender = "%")
    {
        $prepared_sql = "SELECT *, u.name AS last_name, t.name AS team_name 
        FROM users_have_events AS e
        JOIN users AS u ON u.id = e.user_id 
        LEFT JOIN teams AS t ON u.team_id = t.id
        WHERE e.event_date_id = :edid AND e.participant = :yes AND u.gender LIKE :gen
        ORDER BY start_time ASC, number ASC, ISNULL(estimated_finish_time), estimated_finish_time ASC, last_name ASC";
        $data = array(":edid" => $event_date_id, ":yes" => 1, ":gen" => $gender);

        return $this->_db->select($prepared_sql, $data);
    }

    /**
     * Selects supporters of an event date
     * 
     * @param  int $event_date_id  id of the event date 
     * @return array of all suppotes ordered by last name
     */
    public function supporter($event_date_id)
    {
        $prepared_sql = "SELECT *, u.name AS last_name, t.name AS team_name 
        FROM users_have_events AS e
        JOIN users AS u ON u.id = e.user_id 
        LEFT JOIN teams AS t ON u.team_id = t.id
        WHERE e.event_date_id = :edid AND e.support = :yes
        ORDER BY last_name ASC";
        $data = array(":edid" => $event_date_id, ":yes" => 1);

        return $this->_db->select($prepared_sql, $data);
    }

    /**
     * Selects participants sorted by finish time
     * 
     * @param int $event_date_id  id of the event date 
     * @param str $gender optional M, W, O  default: all
     * @param str $team_name optional name of a team, as default searches for all team names 
     * @return array of all participants ordered by finishtime
     */
    public function results($event_date_id, $gender = "%", $team_name = "%")
    {
        $prepared_sql = "SELECT *, u.name AS last_name, t.name AS team_name
        FROM users_have_events AS e
        JOIN users AS u ON u.id = e.user_id 
        LEFT JOIN teams AS t ON u.team_id = t.id
        WHERE e.event_date_id = :edid AND e.participant = :yes AND u.gender = :gen AND IFNULL(t.name, ' ') LIKE :team
        ORDER BY gender ASC, ISNULL(netto_finish_time), netto_finish_time ASC, last_name ASC"; // ISNULL() sorts netto_finish_times == null at the end of the list
        $data = array(":edid" => $event_date_id, ":yes" => 1, ":gen" => $gender, ":team" => "%" . $team_name);

        return $this->_db->select($prepared_sql, $data);
    }

    /**
     * Selects different teams which participate in an event
     * 
     * @param int $event_date_id  id of the event date 
     *
     * @return array of all team names dictinct
     */
    public function teamNames($event_date_id)
    {
        $prepared_sql = "SELECT DISTINCT t.name AS team_name
        FROM users_have_events AS e
        JOIN users AS u ON u.id = e.user_id 
        LEFT JOIN teams AS t ON u.team_id = t.id
        WHERE e.event_date_id = :edid AND e.participant = :yes
        ORDER BY team_name ASC";

        $data = array(":edid" => $event_date_id, ":yes" => 1);

        return $this->_db->select($prepared_sql, $data);
    }

}

?>