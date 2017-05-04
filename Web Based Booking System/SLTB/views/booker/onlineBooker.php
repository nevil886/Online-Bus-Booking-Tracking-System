<?php //print_r($this->searchAllBoardingPoint)  
Session::init();
foreach (Session::get('sessionforSelectin_s') as $key => $value) {
            $book_numberOfSeat = ++$key;
}
?>
<h1>Booking Details</h1>
<div class="busdataarea">
            <label><b>Booking Date : </b></label><label><?php echo $this->busDara['book_date'];?></label><br/>
            <label><b>Bus Number : </b></label><label><?php echo $this->busDara['book_busNo']; ?></label><br/>
            <label><b>Number of Seat : </b></label><label><?php echo $book_numberOfSeat; ?></label><br/>
            <label><b>Total Amount : </b></label><label><?php echo $this->busDara['book_total_ammount']; ?></label>
</div>
<div id="timeOutBooking" style="text-align:center; color: #d14"></div>

<form id="" action="<?php echo URL; ?>bookingSeat/onlineBookerConform/" method="post">

    <input type="hidden" name="selecting_s" id="selecting_s" value="">
    <input type="hidden" name="book_date" id="seat_book_date" value="<?php echo $this->busDara['book_date']; ?>"/>
    <input type="hidden" name="book_journeyNo" id="seat_book_journeyNo" value="<?php echo $this->busDara['book_journeyNo']; ?>"/>
    <input type="hidden" name="book_busNo" id="seat_book_busNo" value="<?php echo $this->busDara['book_busNo']; ?>"/>
    <input type="hidden" name="book_numberOfSeat" id="seat_book_numberOfSeat" value="<?php echo $this->busDara['book_numberOfSeat']; ?>"/>
    <input type="hidden" name="book_price" id="seat_book_price" value="<?php echo $this->busDara['book_price']; ?>"/>
    <input type="hidden" name="book_total_ammount" id="seat_book_price" value="<?php echo $this->busDara['book_total_ammount']; ?>"/>


    
    <div id="passenger_info_m">
        <h3 style ="margin-bottom:10px; margin-top:10px">Passenger Information form</h3>
        <div id="passenger_info">
        </div>
    </div>
    
    <div id="booker_info">
        <h3 style ="margin-bottom:10px; margin-top:10px">Booker Details</h3>
        <div>
            <label>Booker NIC :</label>
            <input name="booker_nic" type="text" maxlength="10" class="" id="booker_nic" data-validation="required" style="width: 200px;" value=""/><input type="button" name="" id="booker_data" value="Check"><br/>
            <label>Booker Name :</label>
            <input name="bookername" type="text" class="" id="bookername" data-validation="required" style="width: 200px;" value=""/><br/>
            <label>Mobile No :</label>
            <input name="booker_mno" type="text" class="" id="booker_mno" data-validation="required" style="width: 200px;" value=""/><br/>
            <label>Entry Point :</label>
            <select name="boardpoint" class="" id="onboardpoint" data-validation="required" style="width: 200px; height: 25px;">
                <option value="">Select Boarding Point</option>
                <?php
                foreach ($this->searchAllBoardingPoint as $key => $value) {
                    echo '<option value="' . $value['entryPointNo'] . '" > ' . $value['entryPoint'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div style ="width: 50%; float: right; margin-top: -150px; margin-right: 0px; padding: 15px;">
            <input type="submit" name="Conform_o_b" id="" value="Conform Booking">	
        </div>
    </div>
</form>