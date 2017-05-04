<div class="main-button">
    <button class="btn"><a href="<?php echo URL; ?>bus"><img class="table-button"/></a></button>
    <button class="btn"><a href="<?php echo URL; ?>bus/create"><img class="add-button"/></a></button>
</div>

<div class="main-form">
    <h1>Edit Bus</h1>
    <?php
    $url = explode('/', $_GET['url']);
    if (isset($url[2])) {
        if ($url[2] == 'Success')
            echo '<P class="magOk"> Data Edit Successful .... ! </p>';
        if ($url[2] == 'Fail')
            echo '<P class="magNo"> Data Update Fail ... !</p>';
    }
    ?>
    <form id="bus_update_form" action="<?php echo URL; ?>bus/updateBus/" method="post">


        <label for="Bus_busNo" class="required">Bus No</label>
        <label for="Bus_busNo" class="required"><?php
    if (isset($this->bus[0]['busNo'])) {
        echo $this->bus[0]['busNo'];
    }
    ?></label>

        <input type="hidden" size="10" maxlength="10" name="uBus_busNo" value="<?php
            if (isset($this->bus[0]['busNo'])) {
                echo $this->bus[0]['busNo'];
            }
    ?>" id="uBus_busNo" type="text"  data-validation="required" ><br />			

        <label for="Bus_busModel" class="required">Bus Model</label>
        <input size="10" maxlength="15" name="uBus_busModel" value="<?php if (isset($this->bus[0]['busModel'])) echo $this->bus[0]['busModel']; ?>" id="uBus_busModel" type="text" data-validation="required"><br />			

        <label for="Bus_numberOfSeat" class="required">Number Of Seat</label>
        <input size="10" name="uBus_numberOfSeat" value="<?php if (isset($this->bus[0]['numberOfSeat'])) echo $this->bus[0]['numberOfSeat']; ?>" id="uBus_numberOfSeat" type="text" data-validation="number" data-validation-allowing="range[40;49]"><br />			

        <label ></label>
        <input type="submit" name="updateNewBus" id="updateNewBus" value="Save Data">	

    </form>
</div>
