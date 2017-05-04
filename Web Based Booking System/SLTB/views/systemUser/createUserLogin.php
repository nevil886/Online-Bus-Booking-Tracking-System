<div class="main-button">
    <button class="btn"><a href="<?php echo URL; ?>systemUser"><img class="table-button"/></a></button>
</div>

<div class="main-form">
    <?php
    $url = explode('/', $_GET['url']);
    if ($url[3]=='Not User')
        echo '<h1>Create Login</h1>';
    else 
        echo '<h1>Edit Privilege & Reset Password</h1>';
    
    if (isset($url[2])) {
        if ($url[2] == 'Success')
            echo '<P class="magOk"> Data Add Successful .... ! </p>';
        if ($url[2] == 'Fail')
            echo '<P class="magNo"> Data Add Fail ...!</p>';
    }
    ?>
    <form id="user_update_form" action="<?php echo URL; ?>systemUser/createPrivilege/" method="post">


        <label for="UserName" class="required">User Name</label>		
        <input size="10" maxlength="10" name="loginUserName" id="loginUserName" type="text" value="<?php
    if (isset($url[2])) {
        echo $url[2];
    }
    ?>"  data-validation="required" ><br/>		

        <label for="privilege" class="required">Privilege</label>
        <select name="loginPrivilege" id="loginPrivilege" data-validation="required">
            <option value="<?php if (isset($url[3])) {
                   echo $url[3];
               } ?>" selected><?php if (isset($url[3])) {
                   echo $url[3];
               } ?></option>
            <option value="Admin" >Admin</option>
            <option value="Operator" >Operator</option>
            <option value="Booker" >Booker</option>
            <option value="Conduct" >Conductor</option>
        </select><br/>	

        <label ></label>
        <input type="submit" name="createLogin" id="createLogin" value="Save Data">	

    </form>
</div>