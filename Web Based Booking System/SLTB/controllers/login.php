<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        //$this->view->js = array('public/js/jspath.js');
    }

    /*
     * View login page.
     */

    function index() {
        $this->view->render('login/index');
    }
    
    
    /*
     * method in Login class.
     */

    function loginToSystem() {
        $this->model->loginToSystem();
    }
    
    function logout()
    {
        Session::destroy();
        header('location: ' . URL .  'login');
//        echo Session::get('privilege');
//        echo Session::get('loggedIn');
//        echo Session::get('userName');
//        exit;
    }

}

?>
