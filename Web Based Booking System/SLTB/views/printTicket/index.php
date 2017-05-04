
<?php //print_r($this->busTicket)  ?>
<?php
echo '<h1>Print Ticket</h1>';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//echo $this->bookingTicket['bookingID'];
echo '<div class="printBookinName"><h3>Booking Ticket</h3></div>';
echo '<div id="booking_ticket_area">';
echo '<link href="http://localhost/SLTB/public/css/booker/ticket.css" rel="stylesheet"></link>';
if(isset($this->bookingTicket)){
    foreach ($this->bookingTicket as $key => $value) {
    echo '<label class="b_ticket_la">Booking ID  </label><label class="">: '.$value['bookingID'].'</label><br/>';
    echo '<label class="b_ticket_la">Booker NIC  </label><label class="">: '.$value['bookerNICNo'].'</label><br/>';
    echo '<label class="b_ticket_la">Bus No  </label><label class="">: '.$value['busNo'].'</label><br/>';
    echo '<label class="b_ticket_la">Route No  </label><label class="">: '.$value['routeNo'].'</label><br/>';
    echo '<label class="b_ticket_la">Journey  </label>: <label class="">From - '.$value['journeyFrom'].'</label><br/>'; 
    echo '<label class="b_ticket_la"> .</label><label class=""> To - '.$value['journeyTo'].'</label><br/>';
    echo '<label class="b_ticket_la">Entry Point  </label><label class="">: '.$value['entryPoint'].'</label><br/>';
    echo '<label class="b_ticket_la">Number Of Seat  </label><label class="">: '.$value['no_of_seat'].'</label><br/>';
    echo '<label class="b_ticket_la">Ammount  </label><label class="">: '.$value['ammount'].'</label><br/>';
    echo '<label class="b_ticket_la">Date  </label><label class="">: '.$value['date'].'</label><br/><br/>';
    }
}
echo '</div>';
echo '<div class="printBookinbtn"><input type="button" name="" id="test" value="Print"></div>';

echo '<div id="bus_ticket_area_main">';
echo '<h3>Bus Ticket</h3>';
echo '<div id="bus_ticket_sub_area">';
echo '<link href="http://localhost/SLTB/public/css/booker/ticket.css" rel="stylesheet"></link>';
if(isset($this->busTicket)){
    foreach ($this->busTicket as $key => $value) {
    echo '<div id="bus_ticket_area">';
    echo '<label class="b_ticket_la">Ticket No : </label><label class="">'.$value['ticketNo'].'</label><br/>';
    echo '<label class="b_ticket_la"></label><label class="">From - '.$value['journeyFrom'] .'</label>'; 
    echo '<label class="b_ticket_la"></label><label class=""> To - '.$value['journeyTo'].'</label><br/>';
    echo '<label class="b_ticket_la">Seat No : </label><label class="">'.$value['seatNo'].'</label>';
    echo '<label class="">'.' , '.' Gender : </label><label class="">'.$value['gender'].'</label><br/>';
    echo '<label class="b_ticket_la">Date : </label><label class="">'.$value['date'].'</label><br/>';
    echo '<label class="b_ticket_la">Booking ID : </label><label class="">'.$value['bookingID'].'</label><br/><br/>';
    echo '</div>';
    }
}
echo '</div>';
echo '</div>';
echo '<div class="printbusTicketsbtn"><label></label><input type="button" name="" id="printbusTicketsbtn" value="Print"></div>';
?>


