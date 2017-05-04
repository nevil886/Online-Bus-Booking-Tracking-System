<?php

class SystemUser extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
    }

    /*
     * View Bus Seat pages.
     */

    //--------------------------------------
    
    /*
     * method in SystemUser class.
     */

    function setSeatNo() {
        $this->model->setSeatNo();
    }

    function selectBusSeat() {
        $this->model->selectBusSeat();
    }

    function deselectBusSeat() {
        $this->model->deselectBusSeat();
    }

    function serachBusSeat() {
        $this->model->serachBusSeat();
    }

}

?>
