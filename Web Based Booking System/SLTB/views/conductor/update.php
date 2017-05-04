<div class="main-button">
    <button class="btn"><a href="<?php echo URL; ?>conductor"><img class="table-button"/></a></button>
    <button class="btn"><a href="<?php echo URL; ?>conductor/create"><img class="add-button"/></a></button>
</div>
<div class="main-form">
    <h1>Edit Conductor</h1>
    <?php
    $url = explode('/', $_GET['url']);
    if (isset($url[2])) {
        if ($url[2] == 'Success')
            echo '<P class="magOk"> Data Edit Successful .... ! </p>';
        if ($url[2] == 'Fail')
            echo '<P class="magNo"> Data Update Fail ...!</p>';
    }
    ?>
    <form id="conductor_create_form" action="<?php echo URL; ?>conductor/updateConductor/" method="post">


        <label for="conductorNo" class="required">Conductor No</label>		
        <input size="10" maxlength="10" name="uConductorNo" id="uConductorNo" type="text" value="<?php
    if (isset($this->conductor[0]['conductorNo'])) {
        echo $this->conductor[0]['conductorNo'];
    }
    ?> "  data-validation="required" ><br />			

        <label for="conductorName" class="required">Conductor Name</label>
        <input size="15" maxlength="15" name="uConductorName" id="uConductorName" type="text" value="<?php
               if (isset($this->conductor[0]['conductorName'])) {
                   echo $this->conductor[0]['conductorName'];
               }
    ?> "  data-validation="required"><br />			

        <label for="conductorMNo" class="required">Conductor Mobile No</label>
        <input size="10" name="uConductorMNo" id="uConductorMNo" type="text" value="<?php
               if (isset($this->conductor[0]['conductorMNo'])) {
                   echo $this->conductor[0]['conductorMNo'];
               }
    ?> "  data-validation="required"><br />			

        <label for="busNo" class="required">Bus No</label>
        <select name="uBusNo" data-validation="">
            <option value="<?php if (isset($this->conductor[0]['busNo'])) {
                   echo $this->conductor[0]['busNo'];
               } ?>" selected><?php if (isset($this->conductor[0]['busNo'])) {
                echo $this->conductor[0]['busNo'];
            } ?></option>
<?php
foreach ($this->searchAllBus as $key => $value) {
    echo '<option value="' . $value['busNo'] . '" > ' . $value['busNo'] . '</option>';
}
?>
        </select><br/>

        <label ></label>
        <input type="submit" name="updateNewConductor" id="updateNewConductor" value="Add Data">	

    </form>
</div>