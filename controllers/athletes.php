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
        $data['title'] = 'Regeln';

        $this->_view->render('header', $data);
        $this->_view->render('athletes/rules');
        $this->_view->render('footer');
    }

    public function privacy()
    {
        $data['title'] = 'Datenschutz';

        $this->_view->render('header', $data);
        $this->_view->render('athletes/privacy');
        $this->_view->render('footer');
    }

    public function contact()
    {
        $data['title'] = 'Kontakt';

        $this->_view->render('header', $data);
        $this->_view->render('athletes/contact');
        $this->_view->render('footer');
    }
}