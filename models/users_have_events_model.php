
<?php

class Users_have_events_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insert($data)
    {
        // echo "update user controller";
        return $this->_db->insert("users_have_events", $data);
    }

    public function updateColumns($data, $where)
    {
        // echo "update user controller";
        return $this->_db->update("users_have_events", $data, $where);
    }

}
?>