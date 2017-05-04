<?php

class EntryPoint extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        if (Session::get('privilege') != 'Operator')
            $this->error();
    }

    function error() {
        require 'controllers/error.php';
        $controller = new Error();
        $controller->index('Sorry ...! You can not Accsess This Page');
    }

    /*
     * View Entry Point pages.
     */

    function index() {
        $this->view->searchAllEntryPoint = $this->searchAllEntryPoint();
        $this->view->render('entryPoint/index');
    }

    function create() {
        $this->view->render('entryPoint/create');
    }

    function updateFromTable($id) {
        $this->view->entryPoint = $this->model->searchSingleEntryPoint($id);
        $this->view->render('entryPoint/update');
    }

    function update() {
        $this->view->render('entryPoint/update');
    }

    /*
     * method in EntryPoint class.
     */

    function createEntryPoint() {
        $val = $this->model->createEntryPoint($_POST);
        //echo $val;
        if ($val == 1) {
            $mag = 'Success';
            header('location: ' . URL . 'entryPoint/create/' . $mag . '');
        } else {
            $mag = 'Fail/" (' . $val . ') "';
            header('location: ' . URL . 'entryPoint/create/' . $mag . '');
        }
    }

    function updateEntryPoint() {
        $val = $this->model->updateEntryPoint($_POST);
        if ($val == 1) {
            $mag = 'Success';
            header('location: ' . URL . 'entryPoint/update/' . $mag . '');
        } else {
            $mag = 'Fail/" (' . $val . ') "';
            header('location: ' . URL . 'entryPoint/update/' . $mag . '');
        }
    }

    function searchSingleEntryPoint($id) {
        return $this->model->searchAllEntryPoint($id);
    }

    function searchAllEntryPoint() {
        return $this->model->searchAllEntryPoint();
    }

    function deleteEntryPoint($id) {
        $val = $this->model->deleteEntryPoint($id);
        if ($val != 1)
            $mag = ' " Cannot delete " Because This value is use for another table. (You can delete new value)';
        header('location: ' . URL . 'entryPoint/index/' . $mag . '');
    }

}

?>
