<?php
class Welcome extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index() 
    {
        $this->_view->render('welcome');

    }

}
?>