<?php

//require '../libs/Controller.php';
class Booker extends Controller {

    //protected $busDara;

    function __construct() {
        parent::__construct();
        $this->arrayBusData = array();
        Session::init();
        require 'models/bus_model.php';
        require 'models/printTicket_model.php';
        $this->availablelBus = new Bus_Model();
        $this->printTicket = new PrintTicket_Model();
        $this->view->js_1 = array('public/js/booker/default.js');
    }

    function error() {
        require 'controllers/error.php';
        $controller = new Error();
        $controller->index('Sorry ...! You can not Accsess This Page');
    }

    /*
     * method in Booker class.
     */

    function index() {
        if (isset($_POST['searchBuses'])) {
            $this->view->availablelBus = $this->availablelBus->searchAvailablelBus($_POST['journeyFrom'], $_POST['journeyTo']);
            //$this->view->journeyNo = $this->availablelBus->getjourneyNo($_POST['journeyFrom'], $_POST['journeyTo']);
            $this->view->journeyFrom =$_POST['journeyFrom'];
            $this->view->journeyTo = $_POST['journeyTo'];
            $this->view->bookDate = $_POST['dateOfJourney'];
            $this->view->render('booker/availableBus');
        } else {
            header('location: ' . URL);
        }
    }

    function booking() {        //print_r($_POST) ; exit(); 
        if (isset($_POST['bookNow'])) {
            $this->view->js_2 = array('public/js/booker/book_1.js');
            $this->view->js_3 = array('public/js/booker/seat_1.js');
            $this->view->busDara = $_POST;
            $this->view->journeyNo = $this->availablelBus->getjourneyNo2($_POST['book_busNo'],$_POST['book_journeyFrom'], $_POST['book_journeyTo']);
            $this->view->render('booker/booking');
        } else {
            Session::deset('bookingTime');
            Session::deset('seatBookingTime');
            Session::deset('sessionforSelectin_s');
            Session::deset('sessionforSelectin_s_tot_price');
            header('location: ' . URL);
        }
    }

    function viewBusSeat() {
        if (isset($_POST['busNo'])) {
            $this->view->seatDara = $_POST;
            $this->view->render('booker/viewBusSeat', true);
        } else {
            header('location: ' . URL);
        }
    }

    function onlineBooker() {
        if (isset($_POST['Continue'])) {
            $this->view->js_2 = array('public/js/booker/book_1.js');
            $this->view->js_3 = array('public/js/booker/o_m_booker.js');
            $this->view->searchAllBoardingPoint = $this->searchAllBoardingPoint($_POST['book_journeyNo']);
            $this->view->busDara = $_POST;
            $this->view->render('booker/onlineBooker');
        } else {
            Session::deset('bookingTime');
            Session::deset('seatBookingTime');
            Session::deset('sessionforSelectin_s');
            Session::deset('sessionforSelectin_s_tot_price');
            header('location: ' . URL);
        }
    }

    function manualBooker() {
        if (Session::get('privilege') == 'Booker') {
            if (isset($_POST['Continue'])) {
                $this->view->js_2 = array('public/js/booker/book_1.js');
                $this->view->js_3 = array('public/js/booker/o_m_booker.js');
                $this->view->searchAllBoardingPoint = $this->searchAllBoardingPoint($_POST['book_journeyNo']);
                $this->view->busDara = $_POST;
                $this->view->render('booker/manualBooker');
            } else {
                Session::deset('bookingTime');
                Session::deset('seatBookingTime');
                Session::deset('sessionforSelectin_s');
                Session::deset('sessionforSelectin_s_tot_price');
                header('location: ' . URL);
            }
        } else {
            header('location:'. URL.'login');
        }
    }
    
    function payment($new_bookingID){ 
        $this->view->js_2 = array('public/js/booker/o_m_booker.js');
        $this->view->bookingTicket = $this->printTicket->searchbookingTicket($new_bookingID);
        $this->view->render('booker/payment');//echo 'ss';exit();
//        header('location: http://localhost/test/?'.$new_bookingID.$book_total_ammount);
//        exit();
    }

    function xhrIncrementSessionforSelectin_s() {
        $selectin_s = array();
        Session::set('sessionforSelectin_s_tot_price', $_POST['tot_price']);
        $i = 0;
        if ((Session::get('sessionforSelectin_s')) == true) {
            foreach (Session::get('sessionforSelectin_s') as $key => $value) {
                $selectin_s[$i++] = $value;
            }
        }
        $selectin_s[$i] = $_POST['seatNo'];
        Session::set('sessionforSelectin_s', $selectin_s);
        echo json_encode($selectin_s);
    }

    function xhrSubtractionSessionforSelectin_s() {
        $selectin_s = array();
        Session::set('sessionforSelectin_s_tot_price', $_POST['tot_price']);
        $i = 0;
        foreach ($_POST['seatNo'] as $key => $value1) {
            $seat = $value1;
        }
        if ((Session::get('sessionforSelectin_s')) == true) {
            foreach (Session::get('sessionforSelectin_s') as $key => $value) {
                if ($value != $seat)
                    $selectin_s[$i++] = $value;
            }
        }
        //echo $seat;
        Session::set('sessionforSelectin_s', $selectin_s);
        echo json_encode($selectin_s);
    }

    function xhrgetSessionforSelectin_s() {
        $selectin_s = array();
        if ((Session::get('sessionforSelectin_s')) == true) {
            foreach (Session::get('sessionforSelectin_s') as $key => $value) {
                $selectin_s[$key] = $value;
            }
        }
        echo json_encode($selectin_s);
    }

    function xhrgetSessionforSelectin_s_tot() {
        $tot = 0;
        $tot = Session::get('sessionforSelectin_s_tot_price');
        echo json_encode($tot);
    }

    function getSessionSelectin_s() {
        echo json_encode(Session::get('sessionforSelectin_s'));
    }

    function xhrsetSession() {
        Session::set('bookingTime', time());
        Session::set('seatBookingTime', date("H:i:s"));
        echo date("H:i:s");
    }

    function xhrSessionTimeOut() {
        if (Session::get('bookingTime') == true) {
            $time = time() - Session::get('bookingTime');
            if ($time >= 60 * 10) {
                $selectin_s = Session::get('sessionforSelectin_s');
                Session::deset('bookingTime');
                Session::deset('seatBookingTime');
                Session::deset('sessionforSelectin_s');
                Session::deset('sessionforSelectin_s_tot_price');
                echo json_encode($selectin_s);
            } else {
                echo (60 * 10 - $time);
            }
        } //echo json_encode($a);
    }
    
    function xhrtimeOut() {
        if (Session::get('bookingTime') == true) {
            $time = time() - Session::get('bookingTime');
            if ($time >= 60 * 10) {
            } else {
                echo (60 * 10 - $time);
            }
        } //echo json_encode($a);
    }

    function xhrreset() {
        //$selectin_s = Session::get('sessionforSelectin_s');
        Session::deset('bookingTime');
        Session::deset('seatBookingTime');
        Session::deset('sessionforSelectin_s');
        Session::deset('sessionforSelectin_s_tot_price');
        echo json_encode(1);
    }
    
    function xhrClearAllSeate() {

        $this->model->xhrClearAllSeate();
    }

    function xhrserchBookerInfo() {

        $this->model->xhrserchBookerInfo();
    }

    function xhrInsertBookingSeat() {

        $this->model->xhrInsertBookingSeat();
    }

    function searchAllBoardingPoint($id) {
        return $this->model->searchAllBoardingPoint($id);
    }

    function enterBookerInfo() {
        $this->model->enterBookerInfo();
    }

    function updateBookerInfo() {
        $this->model->updateBookerInfo();
    }

    function searchBookerInfo() {
        $this->model->searchBookerInfo();
    }

    function getBookerRepot() {
        $this->model->getBookerRepot();
    }

}

?>
