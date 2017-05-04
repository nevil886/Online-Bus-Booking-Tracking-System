<div class="main-button">
    <button class="btn"><a href="<?php echo URL; ?>entryPoint"><img class="table-button"/></a></button>
    <button class="btn"><a href="<?php echo URL; ?>entryPoint/create"><img class="add-button"/></a></button>
</div>

<div class="main-form">
    <h1>Add New Entry Point</h1>
    <?php
    $url = explode('/', $_GET['url']);
    if (isset($url[2])) {
        if ($url[2] == 'Success')
            echo '<P class="magOk"> Data Add Successful .... ! </p>';
        if ($url[2] == 'Fail')
            echo '<P class="magNo"> This Entry Point already exist .. !</p>';
    }
    ?>
    <form id="entryPoint_create_form" action="<?php echo URL; ?>entryPoint/createEntryPoint/" method="post">


        <label for="entryPoint" class="required">Entry Point</label>		
        <input size="15" maxlength="15" name="cEntryPoint" id="cEntryPoint" type="text"  data-validation="required" ><br />			

        <label ></label>
        <input type="submit" name="addNewEntryPoint" id="addNewEntryPoint" value="Add Data">	

    </form>
</div>