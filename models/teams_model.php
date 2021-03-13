<?php

class Teams_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the team infos by name
     * @param  str $team_name  team_name
     * @return object with team or false
     */
    public function getTeamByName($team_name)
    {
        $prepared_sql = "SELECT * FROM teams WHERE name = :na LIMIT 1";
        $data = array(":na" => $team_name);

        $res = $this->_db->select($prepared_sql, $data);
        if (count($res) == 1) {
            return $res[0];
        } else {
            return false;
        }
    }

    /**
     * inserst new team into db
     * @param str $team_name team name
     * @return int last inserted id (team_id)
     */
    public function insert($team_name)
    {
        $data = array("name" => $team_name);
        
        return $this->_db->insert("teams", $data);
    }


    /**
     * searchs for teams with search string in the team name
     * @param str $str search string
     * @return array() array with teams
     */
    public function searchTeams($str)
    {
        $prepared_sql = "SELECT name FROM teams WHERE name like :na";
        $data = array(":na" => "%" . $str . "%");

        return $this->_db->select($prepared_sql, $data);        
    }     

}
?>
