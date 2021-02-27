<?php
class Users extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo "index user controller";
    }

    public function create()
    {
        echo "create user controller";
    }

    public function store($request)
    {
        echo "store user controller";
    }

    public function show($id)
    {
        echo "show user controller";
    }

    public function edit($user)
    {
        echo "edit user: " . $user . " controller";
    }

    /**
     * update method
     * @param  array $data  array of columns and values
     * @param  array $where array of columns and values
     */
    public function update($data, $where)
    {
        echo "update user controller";
       
    }

    public function destroy($id)
    {
        echo "edit user: " . $id . " controller";
    }
}
?>