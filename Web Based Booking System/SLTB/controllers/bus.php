<?php

class Bus extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        require 'models/journey_model.php';
        $this->busJourneyNo = new Journey_Model();

        if (Session::get('privilege') != 'Operator')
        $this->error();
            
    }

    function error() {
        require 'controllers/error.php';
        $controller = new Error();
        $controller->index('Sorry ...! You can not Accsess This Page');
    }

    /*
     * View Bus pages.
     */

    function index() {
        $this->view->searchAllBus = $this->searchAllBus();
        $this->view->render('bus/index');
    }

    function create() {
        //$this->view->searchAllJourney = $this->busJourneyNo->searchAllJourneyNo();
        $this->view->render('bus/create');
    }

    function update() {
        //$this->view->searchAllJourney = $this->busJourneyNo->searchAllJourneyNo();
        $this->view->render('bus/update');
    }

    function updateFromTable($id) {
        $this->view->searchAllJourney = $this->busJourneyNo->searchAllJourneyNo();
        $this->view->bus = $this->model->searchSingleBus($id);
        $this->view->render('bus/update');
    }
    
    function addJourneytoBus($id) {
        $this->view->searchJourneyforBus = $this->searchJourneyforBus($id);
        $this->view->searchAllJourney = $this->busJourneyNo->searchAvailableAllJourney();
        $this->view->render('bus/addJourneytoBus');
    }
    
    /*
     * method in SystemUser class.
     */

    function createBus() {
//        $data = array();
//		$data['cBus_busNo'] = $_POST['cBus_busNo'];
//		$data['cBus_RouteNo'] = $_POST['cBus_RouteNo'];
//		$data['cBus_busModel'] = $_POST['cBus_busModel'];
//                $data['cBus_numberOfSeat'] = $_POST['cBus_numberOfSeat'];
//                $data['cBus_departureTime'] = $_POST['cBus_departureTime'];
//                $data['cBus_arrivalTime'] = $_POST['cBus_arrivalTime'];
        // @TODO: Do your error checking!
        $val = $this->model->createBus($_POST);
        if ($val == 1) {
            $mag = 'Success';
            header('location: ' . URL . 'bus/create/' . $mag . '');
        } else {
            $mag = 'Fail/" (' . $val . ') "';
            header('location: ' . URL . 'bus/create/' . $mag . '');
        }
    }

    function updateBus() {
//        $data = array();
//        $data['uBus_busNo'] = $_POST['uBus_busNo'];
//        $data['uBus_JourneyNo'] = $_POST['uBus_JourneyNo'];
//        $data['uBus_busModel'] = $_POST['uBus_busModel'];
//        $data['uBus_numberOfSeat'] = $_POST['uBus_numberOfSeat'];
//        $data['uBus_departureTime'] = $_POST['uBus_departureTime'];
//        $data['uBus_arrivalTime'] = $_POST['uBus_arrivalTime'];
        $val = $this->model->updateBus($_POST);
        if ($val == 1) {
            $mag = 'Success';
            header('location: ' . URL . 'bus/update/' . $mag . '');
        } else {
            $mag = 'Fail/" (' . $val . ') "';
            header('location: ' . URL . 'bus/update/' . $mag . '');
        }
    }

    function searchSingleBus($id) {
        return $this->model->searchSingleBus($id);
    }

    function xhrSearchAllBusandJourney() {
        echo json_encode($this->model->xhrSearchAllBusandJourney());
    }
    
    function xhrSearchSingleBus() {
        return $this->model->xhrSearchSingleBus();
    }
    
    function searchAllBus() {
        return $this->model->searchAllBus();
    }

    function deleteBus($d) {
        $val = $this->model->deleteBus($d);
        if ($val != 1)
            $mag = ' " Cannot delete " Because This value is use for another table. (You can delete new value)';
        header('location: ' . URL . 'bus/index/' . $mag . '');
    }
    
    function searchJourneyforBus($id) {
        return $this->model->searchJourneyforBus($id);
    }
    
    function addJourneyforBus() {
        if (isset($_POST)) {
            $val = $this->model->addJourneytoBus($_POST);
            header('location: ' . URL . 'bus/addJourneytoBus/' . $val . '');
        }
    }
    
    function deleteJourneyforBus($id) {
        $url = explode('/', $_GET['url']);
        $val = $this->model->deleteJourneyforBus($url[2], $url[3]);
        header('location: ' . URL . 'bus/addJourneytoBus/' . $val . '');
    }
}

?>
