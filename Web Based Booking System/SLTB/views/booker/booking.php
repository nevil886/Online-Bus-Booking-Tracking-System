<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
<pre>
    <?php //print_r($this->busDara); 
    
    date_default_timezone_set("Asia/Colombo");
    //echo date('d-m-Y H:i:s');
    ?>

</pre>

<div id="page_conten">
    <h2 style="font-size:1.2em;"> Choose seats by clicking the corresponding seat in the layout below:</h2>
    <div class="busdataarea">
        <label><b>Booking Date : </b></label><label><?php echo $this->busDara['book_date']; ?></label><br/>
        <label><b>Bus Number : </b></label><label><?php echo $this->busDara['book_busNo']; ?></label>
    </div>
    <div id="timeOutArea">
        <div class="timeOut" style="text-align:center; color: #d14"></div>
    </div> 
    
    <div id="viweSeat">
    </div>


    <div id="area_selected_seat">
        <form id="" action="<?php echo URL; ?>booker/<?php if (Session::get('privilege') == 'Booker') {
        echo 'manualBooker';
    } else {
        echo 'onlineBooker';
    } ?>/" method="post">
            <input type="hidden" name="selecting_s" id="selecting_s" value=""/>
            <input type="hidden" name="book_date" id="seat_book_date" value="<?php echo $this->busDara['book_date']; ?>"/>
            <input type="hidden" name="book_journeyNo" id="seat_book_journeyNo" value="<?php echo $this->journeyNo[0]['journeyNo']; ?>"/>
            <input type="hidden" name="book_busNo" id="seat_book_busNo" value="<?php echo $this->busDara['book_busNo']; ?>"/>
            <input type="hidden" name="book_numberOfSeat" id="seat_book_numberOfSeat" value="<?php echo $this->busDara['book_numberOfSeat']; ?>"/>
            <input type="hidden" name="book_price" id="seat_book_price" value="<?php echo $this->busDara['book_price']; ?>"/>
            <div class="boder">
                <h3><label> Selected Seat</label></h3>
                <label for="" class="">Total Price</label>
                <input type="text" size="15" name="book_total_ammount" id="total_price_for_selecting_seate" value="0"/>
                <label for="" class="">Seat</label>
                <textarea name="" id="selecting_seate_for_booker" data-validation="required" rows="4" cols="10"></textarea>
                <input style="margin-top:10px" type="submit" name="Continue" value="Continue" />
                <input style="margin: 10px 40px 0px;" type="button" id="reset" value="Reset" />
            </div>
        </form>
    </div>

    <div id="imgseate" style="width:600px;text-align:center;overflow:auto"> 
        <ul id="seatDescription">
            <li id="a_seat" style="">Available Seat</li>
            <li id="b_seat" style="">Booked Seat</li>
            <li id="s_seat" style="">Selected Seat</li>
            <li id="h_seat" style="">Hold Other</li>
        </ul>
    </div>
</div>


<!--<div style="width:580px;text-align:left;margin:5px">	
</div>-->

<!--<p class="book">      <input name="submit" type="image" class="bt" src="images/battons/book.jpg" id="submit" value="Delete" style="width:80px; height:23px;">
    <input name="strid" type="hidden" value="b0E9PQ==">
    <input name="rtbid" type="hidden" value="bmc9PQ==">
    <input name="busdate" type="hidden" value="2014-03-04"></p>-->

<!--<div style="width:580px;text-align:left;margin:5px">	
    <input type="button" id="btnShowNew" value="Show Selected Seats" />
    <input type="button" id="btnShow" value="Show All" />            
</div>

<div style="width:580px;text-align:left;margin:5px">	
    <input type="button" id="btnShowNew" value="Show Selected Seats" />
    <input type="button" id="btnShow" value="Show All" />            
</div>-->