<?php

class Error extends Controller{
    function __construct() {
        parent::__construct();
      }
    function index($msg) {
        $this->view->msg=$msg;
        $this->view->render('error/index');
        exit();
    }
    
}