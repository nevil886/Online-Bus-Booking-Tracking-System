<?php //print_r($this->searchAllBoardingPoint)  ?>
<h1>Booking Details</h1>

<div id="timeOut" style="text-align:center; color: #d14"></div>

<form id="" action="<?php echo URL; ?>bookingSeat/manualBookerConform/" method="post">

    <input type="hidden" name="selecting_s" id="selecting_s" value="">
    <input type="hidden" name="book_date" id="seat_book_date" value="<?php echo $this->busDara['book_date']; ?>"/>
    <input type="hidden" name="book_journeyNo" id="seat_book_journeyNo" value="<?php echo $this->busDara['book_journeyNo']; ?>"/>
    <input type="hidden" name="book_busNo" id="seat_book_busNo" value="<?php echo $this->busDara['book_busNo']; ?>"/>
    <input type="hidden" name="book_numberOfSeat" id="seat_book_numberOfSeat" value="<?php echo $this->busDara['book_numberOfSeat']; ?>"/>
    <input type="hidden" name="book_price" id="seat_book_price" value="<?php echo $this->busDara['book_price']; ?>"/>
    <input type="hidden" name="book_total_ammount" id="seat_book_price" value="<?php echo $this->busDara['book_total_ammount']; ?>"/>


    <h3 style ="margin-bottom:10px; margin-top:10px">Passenger Information form</h3>
    <div id="passenger_info">

    </div>
    <h3 style ="margin-bottom:10px; margin-top:10px">Booker Details</h3>
    <div id="booker_info">
        <div>
            <label>Booker NIC :</label>
            <input name="booker_nic" type="text" class="" data-validation="required" id="booker_nic" style="width: 200px;" value=""/><input type="button" name="" id="booker_data" value="Check"><br/>
            <label>Booker Name :</label>
            <input name="bookername" type="text" class="" data-validation="required" id="bookername" style="width: 200px;" value=""/><br/>
            <label>Mobile No :</label>
            <input name="booker_mno" type="text" class="" data-validation="required" id="booker_mno" style="width: 200px;" value=""/><br/>
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
        <input type="submit" name="Conform_m_b" id="" value="Conform Booking">
   </div>
</form>