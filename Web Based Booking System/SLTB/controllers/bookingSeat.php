<?php

class BookingSeat extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        require 'controllers/booker.php';
        $this->booker = new Booker();

        require 'controllers/sendsms.php';
        $this->sms = new Sendsms();
        
    }

    /*
     * method in BookinSeat class.
     */

    function onlineBookerConform() {
        if (isset($_POST['seat0'])) {
            $new_bookingID = $this->insertBookerInfo($_POST);
            //$this->booker->payment($new_bookingID);
            header('location: ' . URL . 'booker/payment/' . $new_bookingID);
        } else {
            header('location: ' . URL);
        }
    }

    function manualBookerConform() {
        if (isset($_POST['seat0'])) {
            if (Session::get('privilege') == 'Booker') {
                $this->insertMBookerInfo($_POST);
            } else {
                header('location:' . URL . 'login');
            }
        } else {
            header('location: ' . URL);
        }
    }

//    function payment($new_bookingID,$book_total_ammount){
//        echo $new_bookingID;
//        header('location: http://localhost/test/?'.$new_bookingID.$book_total_ammount);
//        exit();
//    }

    function paymentConform() {
        if (isset($_POST['bookingID'])) {
            $time = time() - Session::get('bookingTime');
            if ($time >= 60 * 9) {
                echo 'Time is Not Enough';
            } else {
                $this->seatBookingConform($_POST['bookingID']);
            }
        }
    }

    function seatBookingConform($bookingID) {
        //echo 'ok';


        $rebookingID = $this->model->seatBookingConform($bookingID);
        if ($rebookingID != "") { //echo '-ok2';
            //$smsData = $this->model->getSMSData($rebookingID);
//            foreach ($smsData as $key => $value) {
//                $message = 'Booking ID : "' . $value['bookingID'] . '", Booker NIC : "' . $value['bookerNICNo'] . '", Bus Number : "' . $value['busNo'] . '", Route No : "' . $value['routeNo'] . '",Journey : From - "' . $value['journeyFrom'] . '" To - "' . $value['journeyTo'] . '", Entry Point : "' . $value['entryPoint'] . '", Number Of Seat : "' . $value['no_of_seat'] . '", Ammount : "' . $value['ammount'] . '", Date : "' . $value['date'] . '"';
//            }
            //echo $message;
            //$re = $this->sms->sendSMS(Session::get('booker_mno'), $message);
            header('location: ' . URL . 'printTicket/index/' . $rebookingID . '');
        }
    }

    function insertBookerInfo($data) {
        return $this->model->insertBookerInfo($data);
    }

    function insertMBookerInfo($data) {
        return $this->model->insertMBookerInfo($data);
    }

}

?>
