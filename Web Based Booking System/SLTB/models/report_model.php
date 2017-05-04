<?php

class Report_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllBookingData($formDate, $toDate) {
        return $this->db->select('SELECT 
                busNo,
                journeyNo,
                SUM(no_of_seat) AS no_of_seat,
                SUM(ROUND(ammount,0)) AS ammount
                FROM booking 
                WHERE date BETWEEN "' . $formDate . '" AND "' . $toDate . '" GROUP BY busNo');
    }

    public function getBookingData($formDate, $toDate, $busNo, $journeyNo) {
        return $this->db->select('SELECT 
                busNo,
                journeyNo,
                no_of_seat,
                ammount,
                date
                FROM booking 
                WHERE busNo = "' . $busNo . '" AND journeyNo = "' . $journeyNo . '" AND date BETWEEN "' . $formDate . '" AND "' . $toDate . '" ');
    }

    public function getAllBusBookingData($formDate, $toDate, $busNo) {
        return $this->db->select('SELECT 
                busNo,
                journeyNo,
                no_of_seat,
                ammount,
                date
                FROM booking 
                WHERE busNo = "' . $busNo . '" AND date BETWEEN "' . $formDate . '" AND "' . $toDate . '" ');
    }

    public function getAllJourneyBookingData($formDate, $toDate, $journeyNo) {
        return $this->db->select('SELECT 
                busNo,
                journeyNo,
                no_of_seat,
                ammount,
                date
                FROM booking 
                WHERE journeyNo = "' . $journeyNo . '" AND date BETWEEN "' . $formDate . '" AND "' . $toDate . '" ');
    }

    public function getPassengerData($journeyDate, $busNo) {
        return $this->db->select('SELECT
                                    receive_ticke.seatNo,
                                    receive_ticke.ticketNo,
                                    receive_ticke.passengerName,
                                    receive_ticke.gender,
                                    receive_ticke.bookingID
                                    FROM receive_ticke 
                                    JOIN booking ON receive_ticke.bookingID = booking.bookingID
                                    WHERE booking.busNo ="' . $busNo . '" AND booking.date ="' . $journeyDate . '" AND booking.payment_status ="Ok" ');
    }

    public function getBookerrData($journeyDate, $busNo) {
        return $this->db->select('SELECT
                                    booking.bookingID,
                                    booking.bookerNICNo,
                                    (SELECT bookerName FROM booker WHERE bookerNICNo = booking.bookerNICNo) AS bookerName,
                                    (SELECT entryPoint FROM entry_point WHERE entryPointNo = booking.entryPointNo) AS entryPointNo,
                                    booking.no_of_seat,
                                    booking.ammount,
                                    (SELECT bookerMNo FROM booker WHERE bookerNICNo = booking.bookerNICNo) AS bookerMNo
                                    FROM booking 
                                    WHERE booking.busNo ="' . $busNo . '" AND booking.date ="' . $journeyDate . '" AND booking.payment_status ="Ok" ');
    }

    public function searchBookingData($journeyDate, $busNo, $journeyNo) {
        $resultNumberOfSeat = $this->db->select('SELECT numberOfSeat FROM bus WHERE busNo = "' . $busNo . '";');
        foreach ($resultNumberOfSeat as $key => $value) {
            $numberOfSeat = $value['numberOfSeat'];
        }

        $resultBookingSeat = $this->db->select('SELECT 
                                                booking.bookingID,
                                                (SELECT bookerMNo FROM booker WHERE booker.bookerNICNo = booking.bookerNICNo) AS bookerMNo,
                                                (SELECT entryPoint FROM entry_point WHERE entry_point.entryPointNo = booking.entryPointNo) AS entryPoint,
                                                receive_ticke.ticketNo,
                                                receive_ticke.passengerName,
                                                receive_ticke.gender,
                                                receive_ticke.seatNo
                                                FROM booking
                                                JOIN receive_ticke ON booking.bookingID = receive_ticke.bookingID
                                                WHERE booking.busNo = "' . $busNo . '" 
                                                      AND booking.date = "' . $journeyDate . '" 
                                                      AND booking.journeyNo = "' . $journeyNo . '"
                                                      AND booking.payment_status = "Ok" 
                                                ;');

        $bookingDataArry = array();
        for ($i = 1; $i <= $numberOfSeat; $i++) {
            if (!empty($resultBookingSeat)) {
                $bookingDataArry[$i]['seatNo'] = $i;
                foreach ($resultBookingSeat as $key => $value) {
                    if ($i == $value['seatNo']) {
                        $bookingDataArry[$i]['status'] = 'B';
                        $bookingDataArry[$i]['ticketNo'] = $value['ticketNo'];
                        $bookingDataArry[$i]['passengerName'] = $value['passengerName'];
                        $bookingDataArry[$i]['gender'] = $value['gender'];
                        $bookingDataArry[$i]['entryPoint'] = $value['entryPoint'];
                        $bookingDataArry[$i]['bookerMNo'] = $value['bookerMNo'];
                        break;
                    } else {
                        $bookingDataArry[$i]['status'] = 'A';
                        $bookingDataArry[$i]['ticketNo'] = '-';
                        $bookingDataArry[$i]['passengerName'] = '-';
                        $bookingDataArry[$i]['gender'] = '-';
                        $bookingDataArry[$i]['entryPoint'] = '-';
                        $bookingDataArry[$i]['bookerMNo'] = '-';
                    }
                }
            }
        }

//        foreach ($resultBookingSeat as $key => $value) {
//        for ($i = 1; $i <= $numberOfSeat; $i++) {
//            $bookingDataArry[$i]['seatNo'] = $i;
//            
//                if ($i == $value['seatNo']) {
//                    $bookingDataArry[$i]['status'] = 'Booked';
//                    break;
//                }else {
//                    $bookingDataArry[$i]['status'] = 'Available';
//                    //break;
//                }
//            }            
//        }


        return $bookingDataArry;

//        return $this->db->select('SELECT
//                                  *
//                                  FROM bus
//                                  ' );
    }

    public function xhrSearchBookingData($journeyDate, $busNo, $journeyNo) {
        $resultNumberOfSeat = $this->db->select('SELECT numberOfSeat FROM bus WHERE busNo = "' . $busNo . '";');
        foreach ($resultNumberOfSeat as $key => $value) {
            $numberOfSeat = $value['numberOfSeat'];
        }

        $resultBookingSeat = $this->db->select('SELECT 
                                                booking.bookingID,
                                                (SELECT bookerMNo FROM booker WHERE booker.bookerNICNo = booking.bookerNICNo) AS bookerMNo,
                                                (SELECT entryPoint FROM entry_point WHERE entry_point.entryPointNo = booking.entryPointNo) AS entryPoint,
                                                receive_ticke.ticketNo,
                                                receive_ticke.passengerName,
                                                receive_ticke.gender,
                                                receive_ticke.seatNo
                                                FROM booking
                                                JOIN receive_ticke ON booking.bookingID = receive_ticke.bookingID
                                                WHERE booking.busNo = "' . $busNo . '" 
                                                      AND booking.date = "' . $journeyDate . '" 
                                                      AND booking.journeyNo = "' . $journeyNo . '"
                                                      AND booking.payment_status = "Ok" 
                                                ;');

        $bookingDataArryMain = array();
        $bookingDataArrySub = array();
        $j = 1;
        for ($i = 0; $i < $numberOfSeat; $i++) {
            if (!empty($resultBookingSeat)) {
                $bookingDataArrySub['seatNo'] = $j++;
                foreach ($resultBookingSeat as $key => $value) {
                    if ($bookingDataArrySub['seatNo'] == $value['seatNo']) {
                        $bookingDataArrySub['status'] = 'B';
                        $bookingDataArrySub['ticketNo'] = $value['ticketNo'];
                        $bookingDataArrySub['gender'] = $value['gender'];
                        break;
                    } else {
                        $bookingDataArrySub['status'] = 'A';
                        $bookingDataArrySub['ticketNo'] = '-';
                        $bookingDataArrySub['gender'] = '-';
                    }
                }
                $bookingDataArrySub['busNo'] = $busNo;
                $bookingDataArrySub['journeyDate'] = $journeyDate;
                $bookingDataArrySub['journeyNo'] = $journeyNo;
            }
            $bookingDataArryMain[$i] = $bookingDataArrySub;
        }
//        $bookingDataArryM['status'] = "aaa";
//        $bookingDataArry[0] = $bookingDataArryM;
//        $bookingDataArryM['status'] = "bbb";
//        $bookingDataArry[1] = $bookingDataArryM;
        
        echo json_encode($bookingDataArryMain);
    }

    public function xhrSearchJourneyforSingleBus() {
        $id = $_POST['busNo'];
        $result = $this->db->select('SELECT journeyNo FROM journey_for_bus WHERE busNo = :busNo', array(':busNo' => $id));
        echo json_encode($result);
    }

}

?>
