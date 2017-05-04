<?php

class Conductor extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        require 'models/bus_model.php';
        $this->busNo = new Bus_Model();
        if (Session::get('privilege') != 'Operator')
            $this->error();
    }

    function error() {
        require 'controllers/error.php';
        $controller = new Error();
        $controller->index('Sorry ...! You can not Accsess This Page');
    }

    /*
     * View Conductor pages.
     */

    function index() {
        $this->view->searchAllConductor = $this->searchAllConductor();
        $this->view->render('conductor/index');
    }

    function create() {
        $this->view->searchAllBus = $this->busNo->searchAllBus();
        $this->view->render('conductor/create');
    }

    function updateFromTable($id) {
        $this->view->searchAllBus = $this->busNo->searchAllBus();
        $this->view->conductor = $this->model->searchSingleConductor($id);
        $this->view->render('conductor/update');
    }

    function update() {
        $this->view->searchAllBus = $this->busNo->searchAllBus();
        $this->view->render('conductor/update');
    }

    /*
     * method in Coductor class.
     */

    function createConductor() {
        $val = $this->model->createConductor($_POST);
        if ($val == 1) {
            $mag = 'Success';
            header('location: ' . URL . 'conductor/create/' . $mag . '');
        } else {
            $mag = 'Fail/" (' . $val . ') "';
            header('location: ' . URL . 'conductor/create/' . $mag . '');
        }
    }

    function updateConductor() {
        $val = $this->model->updateConductor($_POST);
        if ($val == 1) {
            $mag = 'Success';
            header('location: ' . URL . 'conductor/update/' . $mag . '');
        } else {
            $mag = 'Fail/" (' . $val . ') "';
            header('location: ' . URL . 'conductor/update/' . $mag . '');
        }
    }

    function searchSingleConductor($id) {
        return $this->model->searchSingleConductor($id);
    }

    function searchAllConductor() {
        return $this->model->searchAllConductor();
    }

    function deleteConductor($id) {
        $val = $this->model->deleteConductor($id);
        if ($val != 1)
            $mag = ' " Cannot delete " Because This value is use for another table. (You can delete new value)';
        header('location: ' . URL . 'conductor/index/' . $mag . '');
    }

}

?>
