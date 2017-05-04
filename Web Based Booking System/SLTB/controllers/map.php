<?php

class Map extends Controller {

    function __construct() {
        parent::__construct();
        
    }

    function error() {
        require 'controllers/error.php';
        $controller = new Error();
        $controller->index('Sorry ...! You can not Accsess This Page');
    }

    function index() {
        $this->view->render('map/index');
    }
    
    function map2() {
        $this->view->render('map/map2');
    }

    
}

?>
