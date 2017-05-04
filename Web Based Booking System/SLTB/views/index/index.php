<!--<script>
    $(window).unload(function(){
        console.log('s');
    });
</script>-->

<?php 
//print_r(date("Y-m-d"));
//echo date("H:i:s")
date_default_timezone_set("Asia/Colombo");
    //echo date('d-m-Y H:i:s');
?>

<h1>Welcome Booking Center ...! </h1>.

<div class="abc">
    <form id="search_buses_form" action="<?php echo URL; ?>booker/" method="post">
        
        <label for="journeyFrom" class="required">Journey From</label>
        <select class="select" name="journeyFrom" id="journeyFrom" style="width:110px;" data-validation="required">
            <option value="" >Select From</option>
            <?php
            $journeyFrom = null;
            foreach ($this->journeyFrom as $key => $value) {
                if($value['journeyFrom'] == $journeyFrom){}
                else{
                echo '<option value="' . $value['journeyFrom'] . '">' . $value['journeyFrom'] . '</option>';
                $journeyFrom = $value['journeyFrom'];
                }
            }
            ?>
        </select><br/>
        <label for="journeyTo" class="required">Journey To</label>
        <select class="select" name="journeyTo" id="journeyTo" style="width:110px;" data-validation="required">
            <option value="" >Select To</option>
            <?php
            foreach ($this->journeyTo as $key => $value) {
                echo '<option value="' . $value['journeyTo'] . '">' . $value['journeyTo'] . '</option>';
            }
            ?>
        </select><br/>

        <label for="dateofJourney" class="required">Date</label>
        <input  style="width:110px;" name="dateOfJourney" id="dateOfJourney" type="text" class="datepicker_bus_date" data-validation="required" value="<?php echo date("Y-m-d"); ?>"><br />
        <label ></label>
        <input style="margin:5px 25px 0;" type="submit" name="searchBuses" id="searchBuses" value="Search Buses">	

    </form>     
</div>



