<!--http://formvalidator.net/#default-validators-->
<div class="main-button">
    <button class="btn"><a href="<?php echo URL; ?>systemUser"><img class="table-button"/></a></button>
    <button class="btn"><a href="<?php echo URL; ?>systemUser/create"><img class="add-button"/></a></button>
</div>

<div class="main-form">
    <h1>Add New System User</h1>
    <?php
    $url = explode('/', $_GET['url']);
    if (isset($url[2])) {
        if ($url[2] == 'Success')
            echo '<P class="magOk"> Data Add Successful .... ! </p>';
        if ($url[2] == 'Fail')
            echo '<P class="magNo"> This User already exist .. !</p>';
    }
    ?>
    <form id="user_update_form" action="<?php echo URL; ?>systemUser/createSystemUser/" method="post">


        <label for="cUserName" class="required">User Name</label>		
        <input size="10" maxlength="10" name="cUserName" id="cUserName" type="text"  data-validation="required" ><br />			

        <label for="cEmpolyeeNo" class="required">Empolyee No</label>
        <input size="10" maxlength="15" name="cEmpolyeeNo" id="cEmpolyeeNo" type="text" data-validation="required"><br />			

        <label for="cEmpolyeeName" class="required">Empolyee Name</label>
        <input size="20" name="cEmpolyeeName" id="cEmpolyeeName" type="text" data-validation="required"><br />			

        <label for="cEmpolyeeMNo" class="required">Mobile No</label>
        <input size="10" name="cEmpolyeeMNo" id="cEmpolyeeMNo" type="text" data-validation="required"><br />			

        <label ></label>
        <input type="submit" name="addNewUser" id="addNewBus" value="Add Data">	

    </form>
</div>