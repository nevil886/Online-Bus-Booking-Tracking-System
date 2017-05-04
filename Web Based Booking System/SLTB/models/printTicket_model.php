<?php
class PrintTicket_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function searchbookingTicket($val) {
         return $this->db->select('SELECT
                booking.bookingID,
                booking.bookerNICNo,
                booking.busNo,
                booking.ammount,
                booking.no_of_seat,
                booking.date,
                booking.payment_status,
                journey.routeNo,
                journey.journeyFrom,
                journey.journeyTo,
                (SELECT entryPoint FROM entry_point WHERE entryPointNo = booking.entryPointNo) AS entryPoint
                FROM booking 
                JOIN journey ON booking.journeyNo = journey.journeyNo
                WHERE booking.bookingID ="' . $val . '"');
        
    }
    
    public function searchBusTicket($val) {
        return $this->db->select('SELECT
                receive_ticke.ticketNo,
                receive_ticke.bookingID,
                receive_ticke.seatNo,
                receive_ticke.gender,
                (SELECT journeyFrom FROM journey WHERE journeyNo = booking.journeyNo) AS journeyFrom,
                (SELECT journeyTo FROM journey WHERE journeyNo = booking.journeyNo) AS journeyTo,
                booking.date
                FROM receive_ticke 
                JOIN booking ON receive_ticke.bookingID = booking.bookingID
                WHERE receive_ticke.bookingID ="' . $val . '"');
        
    }
    
    public function searchBusTicketInfo() {

        try {
            
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }
    public function printTicket() {

        try {
            
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }
}
?>
