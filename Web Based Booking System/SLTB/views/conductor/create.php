<div class="main-button">
    <button class="btn"><a href="<?php echo URL; ?>conductor"><img class="table-button"/></a></button>
    <button class="btn"><a href="<?php echo URL; ?>conductor/create"><img class="add-button"/></a></button>
</div>
<div class="main-form">
    <h1>Add New Conductor</h1>
    <?php
    $url = explode('/', $_GET['url']);
    if (isset($url[2])) {
        if ($url[2] == 'Success')
            echo '<P class="magOk"> Data Add Successful .... ! </p>';
        if ($url[2] == 'Fail')
            echo '<P class="magNo"> This Conductor already exist .. !</p>';
    }
    ?>
    <form id="conductor_create_form" action="<?php echo URL; ?>conductor/createConductor/" method="post">


        <label for="conductorNo" class="required">Conductor No</label>		
        <input size="10" maxlength="10" name="cConductorNo" id="cConductorNo" type="text"  data-validation="required" ><br />			

        <label for="conductorName" class="required">Conductor Name</label>
        <input size="15" maxlength="15" name="cConductorName" id="cConductorName" type="text" data-validation="required"><br />			

        <label for="conductorMNo" class="required">Conductor Mobile No</label>
        <input size="10" name="cConductorMNo" id="cConductorMNo" type="text" data-validation="required"><br />			

        <label for="busNo" class="required">Bus No</label>
        <select name="cBusNo" data-validation="">
            <option ></option>
            <?php
            foreach ($this->searchAllBus as $key => $value) {
                echo '<option value="'.$value['busNo'].'" > ' . $value['busNo'] . '</option>';
            }
            ?>
        </select><br/>
        
        <label ></label>
        <input type="submit" name="addNewConductor" id="addNewConductor" value="Add Data">	

    </form>
</div>