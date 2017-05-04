<?php

class Journey extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        require 'models/entryPoint_model.php';
        $this->busEnrtyPointNo = new EntryPoint_Model();
        
        if (Session::get('privilege') != 'Operator')
            $this->error();
    }

    function error() {
        require 'controllers/error.php';
        $controller = new Error();
        $controller->index('Sorry ...! You can not Accsess This Page');
    }

    /*
     * View Route pages.
     */

    function index() {
        $this->view->searchAllJourney = $this->searchAllJourney();
        $this->view->render('journey/index');
    }

    function create() {
        $this->view->render('journey/create');
    }

    function updateFromTable($id) {
        $this->view->journey = $this->searchSingleJourney($id);
        $this->view->render('journey/update');
    }

    function update() {
        $this->view->render('journey/update');
    }

    function entryPoint($id) {
        $this->view->searchEntryPointForJourney = $this->searchEntryPointForJourney($id);
        $this->view->searchAllEnrtyPointNo = $this->busEnrtyPointNo->searchAllEnrtyPointNo();
        $this->view->render('journey/entryPoint');
    }

    /*
     * method in SystemUser class.
     */

    function createJourney() {
        $val = $this->model->createJourney($_POST);
        //echo $val;
        if ($val == 1) {
            $mag = 'Success';
            header('location: ' . URL . 'journey/create/' . $mag . '');
        } else {
            $mag = 'Fail/" (' . $val . ') "';
            header('location: ' . URL . 'journey/create/' . $mag . '');
        }
    }

    function updateJourney() {
        $val = $this->model->updateJourney($_POST);
        if ($val == 1) {
            $mag = 'Success';
            header('location: ' . URL . 'journey/update/' . $mag . '');
        } else {
            $mag = 'Fail/" (' . $val . ') "';
            header('location: ' . URL . 'journey/update/' . $mag . '');
        }
    }

    function searchSingleJourney($id) {
        return $this->model->searchSingleJourney($id);
    }

    function xhrSearchSingleJourney() {
        $id=$_POST['jNo'];
        echo json_encode($this->model->searchSingleJourney($id));
    }
    
    function searchAllJourney() {

        return $this->model->searchAllJourney();
    }

    function searchEntryPointForJourney($id) {

        return $this->model->searchEntryPointForJourney($id);
    }

    function deleteJourney($id) {
        $val = $this->model->deleteJourney($id);
        if ($val != 1)
            $mag = ' " Cannot delete " Because This value is use for another table. (You can delete new value)';
        header('location: ' . URL . 'journey/index/' . $mag . '');
    }

    function addEntryPointForJourney() {
        if (isset($_POST)) {
            $val = $this->model->addEntryPointForJourney($_POST);
            header('location: ' . URL . 'journey/entryPoint/' . $val . '');
        }
    }

    function deleteEntryPointForJourney($id) {
        $url = explode('/', $_GET['url']);
//        echo $url[2];
//        echo $url[3];
//        exit();
        $val = $this->model->deleteEntryPointForJourney($url[2], $url[3]);
        header('location: ' . URL . 'journey/entryPoint/' . $val . '');
    }
    
    
}

?>
