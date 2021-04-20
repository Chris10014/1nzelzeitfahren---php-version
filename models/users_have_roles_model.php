<?php

class Users_have_roles_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Check if a user is admin
     * @param INT $id user id
     * @return boolean true (is admin) or false (is not an admin)
     */
    public function checkRoleAdmin($user_id)
    {
        $prepared_sql = "SELECT * FROM users_have_roles WHERE user_id = :uid LIMIT 1";
        $data = array(":uid" => $user_id);
        $role_id = $this->_db->select($prepared_sql, $data);
        if(count($role_id) == 1 AND $role_id[0]['role_id'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function insert($data)
    {
        // echo "update user controller";
        return $this->_db->insert("users_have_roles", $data);
    }

    public function updateColumns($data, $where)
    {
        // echo "update user controller";
        return $this->_db->update("users_have_roles", $data, $where);
    }

}
