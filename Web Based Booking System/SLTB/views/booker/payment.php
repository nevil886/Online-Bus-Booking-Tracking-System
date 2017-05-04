<div id="timeOutBooking" style="text-align:center; color: #d14"></div>
<?php //print_r($this->bookingTicket)      ?>
<?php
echo '<div class="printBookinName"><h3>Booking Tikect</h3></div>';
echo '<link href="http://localhost/SLTB/public/css/booker/ticket.css" rel="stylesheet"></link>';
echo '<div id="booking_ticket_area">';
if (isset($this->bookingTicket)) {
    foreach ($this->bookingTicket as $key => $value) {
        echo '<label class="b_ticket_la">Booking ID  </label><label class="">: ' . $value['bookingID'] . '</label><br/>';
        echo '<label class="b_ticket_la">Booker NIC  </label><label class="">: ' . $value['bookerNICNo'] . '</label><br/>';
        echo '<label class="b_ticket_la">Bus No  </label><label class="">: ' . $value['busNo'] . '</label><br/>';
        echo '<label class="b_ticket_la">Route No  </label><label class="">: ' . $value['routeNo'] . '</label><br/>';
        echo '<label class="b_ticket_la">Journey  </label>: <label class="">From - ' . $value['journeyFrom'] . '</label><br/>';
        echo '<label class="b_ticket_la"> .</label><label class=""> To - ' . $value['journeyTo'] . '</label><br/>';
        echo '<label class="b_ticket_la">Entry Point  </label><label class="">: ' . $value['entryPoint'] . '</label><br/>';
        echo '<label class="b_ticket_la">Number Of Seat  </label><label class="">: ' . $value['no_of_seat'] . '</label><br/>';
        echo '<label class="b_ticket_la">Ammount  </label><label class="">: ' . $value['ammount'] . '</label><br/>';
        echo '<label class="b_ticket_la">Date  </label><label class="">: ' . $value['date'] . '</label><br/>';
        echo '<label class="b_ticket_la">payment Status  </label><label class="">: Pending</label><br/><br/>';
    }
}
echo '</div>';

    
?>
<form id="" action="http://localhost/E-Wallet_files/E-Wallet.php" method="post">
    <?php
    if (isset($this->bookingTicket))
        foreach ($this->bookingTicket as $key => $value) {
            echo '<input type="hidden" name="bookingID" id="selecting_s" value="' . $value['bookingID'] . '">';
            echo '<input type="hidden" name="ammount" id="selecting_s" value="' . $value['ammount'] . '">';
        }
    ?>
    <div class="payment">
        <div style ="width: 50%; float: right; margin-top: -150px; margin-right: 0px; padding: 15px;">
            <input type="radio" name="payMethord" id="" value="" checked="checked" style="width: 30px;" />Dialog EZ Cash<br/>
            <input type="radio" name="payMethord" id="" value=""  style="width: 30px;" />VISA / MASTER<br/>
            <input type="radio" name="payMethord" id="" value="" style="width: 30px;"/>PayPal<br/>
            <input type="submit" name="payment" id="" value="Conform Payment">	
        </div>
    </div>
</form>