<?php

class Booker_Model extends Model {

    public function __construct() {
        parent::__construct();
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Session::init();
        date_default_timezone_set("Asia/Colombo");
        //echo date('d-m-Y H:i:s');
    }

    public function xhrSearchAvailableSeat($b, $d, $j) {

        $busNo = $b;
        $date = $d;
        $journeyNo = $j;
        $result = $this->db->select('SELECT seatNo, status FROM available_seat 
            WHERE busNo ="' . $busNo . '" AND journeyNo ="' . $journeyNo . '" AND date ="' . $date . '" ');
        return $result;
    }

    public function xhrInsertBookingSeat() {

        $result = $this->db->insert('available_seat', array(
            'seatNo' => $_POST['seatNo'],
            'busNo' => $_POST['busNo'],
            'journeyNo' => $_POST['journeyNo'],
            'status' => $_POST['status'],
            'date' => $_POST['bus_book_date'],
            'time' => Session::get('seatBookingTime')
                ));

        echo json_encode($result);
    }

    public function xhrClearAllSeate() {

        $busNo = $_POST['busNo'];
        $journeyNo = $_POST['journeyNo'];
        $date = $_POST['bus_book_date'];
        $seatNo = $_POST['seatNo'];
        $status = $_POST['status'];
        //print_r($seatNo) ;
        $this->db->beginTransaction();
        try {
            foreach ($seatNo as $value) {
                $sth = $this->db->prepare('DELETE FROM available_seat 
                WHERE
                status="' . $status . '" AND
                busNo="' . $busNo . '" AND 
                date="' . $date . '" AND
                journeyNo="' . $journeyNo . '" AND
                seatNo="' . $value . '" ');
                $sth->execute();
            }
            echo json_encode($this->db->commit());
        } catch (Exception $e) {
            $this->db->rollBack();
            echo json_encode($e->getMessage());
        }
    }

    public function searchAllBoardingPoint($id) {
        return $this->db->select('SELECT
                entry_point.entryPointNo,
                entry_point.entryPoint 
                FROM entry_point JOIN entrypoint_for_journey ON entry_point.entryPointNo = entrypoint_for_journey.entryPointNo 
                WHERE entrypoint_for_journey.journeyNo ="' . $id . '"');
    }
    
    public function xhrserchBookerInfo() {
      $nic = $_POST['booker_nic'];
      $result = $this->db->select('SELECT * FROM booker WHERE bookerNICNo ="' . $nic . '" ');
      echo json_encode($result);
    }

    public function updateBookerInfo() {

        try {
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    
    public function searchBookerInfo() {

        try {
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getBookerRepot() {

        try {
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    

}
?>


