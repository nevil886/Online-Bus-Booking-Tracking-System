<!--http://formvalidator.net/#default-validators-->
<div class="main-button">
    <button class="btn"><a href="<?php echo URL; ?>journey"><img class="table-button"/></a></button>
    <button class="btn"><a href="<?php echo URL; ?>journey/create"><img class="add-button"/></a></button>
</div>

<div class="main-form">
    <h1>Add New Journey</h1>
    <?php
    $url = explode('/', $_GET['url']);
    if (isset($url[2])) {
        if ($url[2] == 'Success')
            echo '<P class="magOk"> Data Add Successful .... ! </p>';
        if ($url[2] == 'Fail')
            echo '<P class="magNo"> This Journey Number already exist .. !</p>';
    }
    ?>
    <form id="bus_create_form" action="<?php echo URL; ?>journey/createJourney/" method="post">

        <label for="journeyNo" class="required">Journey No</label>
        <input size="10" maxlength="10" name="cJNo" id="cJourneyNo" type="text" data-validation="required"><br />
        
        <label for="routeNo" class="required">Route No</label>
        <input size="10" maxlength="10" name="cRouteNo" id="cRouteNo" type="text" data-validation="required"><br />			

        <label for="journeyFrom" class="required">Journey From</label>
        <input size="10" name="cJourneyFrom" id="cJourneyFrom" type="text" data-validation="required"><br />			

        <label for="journeyTo" class="required">Journey To</label>
        <input size="10" name="cJourneyTo" id="cJourneyTo" type="text" data-validation="required"><br />
        
        <label for="Bus_departureTime" class="required">Departure Time</label>
        <input size="10" name="cBus_departureTime" id="Bus_departureTime" type="text" value="00:00" data-validation="required"> 24 Hours<br />			

        <label for="Bus_arrivalTime" class="required">Arrival Time</label>
        <input  size="10" name="cBus_arrivalTime" id="Bus_arrivalTime" type="text" value="24:00" data-validation="required"> 24 Hours<br />


        <label for="price" class="required">Price</label>
        <input  size="10" name="cPrice" id="cPrice" type="text" data-validation="required"><br />

        <label ></label>
        <input type="submit" name="addNewJourney" id="addNewJourney" value="Add Data">	

    </form>
</div>