<?php

class Registration_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Gibt den user zurück, bei dem E-Mail und RegCode zusammen passen.
     * @return array User mit allen Feldern
     */
    public function checkRegCode($regCode) {
        $prepared_sql = "SELECT * FROM users WHERE email = :em AND reg_code = :rc LIMIT 1";
        $data = array([":em" => $_SESSION['email'], ":rc" => $regCode]);

        return $this->_db->select($prepared_sql, $data);
    }


    /**
     * Gibt den user zurück, der zur E-Mail passt.
     * @return array User mit allen Feldern
     */
    public function findEmail($email)
    {
        $prepared_sql = "SELECT * FROM users WHERE email = :em LIMIT 1";
        $data = array(":em" => $email);

        return $this->_db->select($prepared_sql, $data);
    }
}
?>