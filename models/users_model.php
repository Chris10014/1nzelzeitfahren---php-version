<?php

class Users_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function all() 
    {
        return $this->_db->select('SELECT * FROM users ORDER BY name DESC');
    }

    /**
     * Find a user who machtes with email address
     * @param str $email email address
     * @return array with one or null user with all fields 
     */
    public function findByEmail($email) {
        $prepared_sql = "SELECT * FROM users WHERE email = :em LIMIT 1";
        $data = array(":em" => $email);

        return $this->_db->select($prepared_sql, $data);
    }

    /**
     * Find a user who machtes with user id
     * @param INT $id user id
     * @return array with one or null user with all fields 
     */
    public function findById($user_id)
    {
        $prepared_sql = "SELECT * FROM users WHERE id = :uid LIMIT 1";
        $data = array(":uid" => $user_id);

        return $this->_db->select($prepared_sql, $data);
    }

    /**
     * Find user who machtes reg code and email address
     * @param integer $regCode 4 digit code for registration
     * @return array with one or null user with all fields 
     */
    public function findByRegCode($regCode)
    {
        $hashedRegCode = hash("MD5", $regCode);
        $prepared_sql = "SELECT * FROM users WHERE email = :em AND reg_code = :rc LIMIT 1";
        $data = array(":em" => $_SESSION['email'], ":rc" => $hashedRegCode);

        return $this->_db->select($prepared_sql, $data);
    }

    /**
     * Updates one or mor columns of the user table
     * @param  array $data  array of columns and values
     * @param  array $where array of columns and values
     * @return array
     */
    public function updateColumns($data, $where)
    {
        // echo "update user controller";
        
        return $this->_db->update("users", $data, $where);
    }

    /**
     * Get the team the user belongs to
     * @param  int $id  user id
     * @return object with team or false
     */
    public function team($user_id)
    {
        $prepared_sql = "SELECT * FROM teams WHERE id = :uid LIMIT 1";
        $data = array(":uid" => $user_id);

        $res = $this->_db->select($prepared_sql, $data);
        if(count($res) == 1) {
            return $res[0];
        } else {
            return false;
        }
    }

    /**
     * Finds if a user is already registered for an event date
     * @param  int $user_id  user id
     * @param int $event_date_id
     * @return boolean true or false
     */
    public function isUserRegistered($user_id, $event_date_id)
    {
        $prepared_sql = "SELECT * FROM users_have_events WHERE user_id = :uid AND event_date_id = :edid LIMIT 1";
        $data = array(
            ":uid" => $user_id, 
            ":edid" => $event_date_id
        );

        $res = $this->_db->select($prepared_sql, $data);
        if (count($res) == 1) {
            return true;
        } else {
            return false;
        }
    }


    
}
