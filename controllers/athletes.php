<?php


class Athletes extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    }
    
    public function rules()
    {
        $data['title'] = 'Rules';

        $this->_view->render('header', $data);
        $this->_view->render('athletes/rules');
        $this->_view->render('footer');
    }
}