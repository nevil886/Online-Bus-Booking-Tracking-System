<html>
    <head>

        <title>SLTB</title>
        <!--link for javascript defalt-->
        <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>public/js/default.js"></script>

        <!--link for javascript validation-->
        <script type="text/javascript" src="<?php echo URL; ?>public/js/form_validation/jquery.form-validator.min.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>public/js/form_validation/customValidation.js"></script>


<!--<script type="text/javascript" src="<?php echo URL; ?>public/js/booker/seat.js"></script>-->

        <!--link for javascript data table-->
        <script type="text/javascript" src="<?php echo URL; ?>public/js/table/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>public/js/table/customTables.js"></script>

        <!--link for javascript date&time-->
        <script type="text/javascript" src="<?php echo URL; ?>public/js/date&time/jQuery.ptTimeSelect.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>public/js/date&time/jquery-ui-1.8.22.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>public/js/date&time/jquery.ui.timepicker.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>public/js/date&time/customDateTime.js"></script>

        <!--link for javascript Parse-->
        <script type="text/javascript" src="<?php echo URL; ?>public/js/report.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>public/js/map/parse-1.2.18.min.js"></script>
        
        
        <!--link for stylesheet for defalt-->
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/report.css" />

        <!--link for stylesheet for booker-->
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/booker/seat.css" />

        <!--link for stylesheet for data table-->
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/table/demo_page.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/table/demo_table.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/table/demo_table_jui.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/table/jquery-ui-1.8.4.custom.css" />

        <!--link for stylesheet for date&time-->
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/date&time/jquery.ptTimeSelect.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/date&time/jquery.ui.timepicker.css" />

        <!--<link rel="stylesheet" href="<?php echo URL; ?>public/css/booker/ticket.css" />-->


        <?php
        if (isset($this->js_1)) {
            foreach ($this->js_1 as $js) {
                echo '<script type="text/javascript" src="' . URL . $js . '"></script>';
            }
        }
        if (isset($this->js_2)) {
            foreach ($this->js_2 as $js) {
                echo '<script type="text/javascript" src="' . URL . $js . '"></script>';
            }
        }
        if (isset($this->js_3)) {
            foreach ($this->js_3 as $js) {
                echo '<script type="text/javascript" src="' . URL . $js . '"></script>';
            }
        }
        ?>  

    </head>

    <body>
        <?php Session::init(); ?>
        <div id="pagewrapper">
            <div id="topbg"></div>
            <div id="logo"><div id="systemName"><h1>SLTB Bus Booking</h1></div></div>
            <div id="header">
                <div id="mainmenu">
                    <header>
                        <ul>
                            <?php if (Session::get('privilege') != 'Admin' && Session::get('privilege') != 'Operator' && Session::get('privilege') != 'Conduct'): ?>
                                <li><a href="<?php echo URL; ?>index">Home</a></li>
                            <?php endif; ?>
                            <?php if (Session::get('privilege') == 'Admin'): ?>
                                <li><a href="<?php echo URL; ?>systemUser">Create Login</a></li>
                                <li><a href="<?php echo URL; ?>report">Report</a></li>
                            <?php endif; ?>
                            <?php if (Session::get('privilege') == 'Operator'): ?>
                                <li><a href="<?php echo URL; ?>systemUser">System User</a></li>
                                <li><a href="<?php echo URL; ?>bus">Bus</a></li>
                                <li><a href="<?php echo URL; ?>journey">Journey</a></li>
                                <li><a href="<?php echo URL; ?>entryPoint">Entry Point</a></li>
                                <li><a href="<?php echo URL; ?>conductor">Conductor</a></li>
                            <?php endif; ?>
                            <?php if (Session::get('privilege') == 'Conduct'): ?>
                                <li><a href="<?php echo URL; ?>report">Report</a></li>
                            <?php endif; ?>
                            <?php if (Session::get('loggedIn') == true): ?>
                                <li><a href="<?php echo URL; ?>systemUser/changePassword">Change Password</a></li>
                                <li><a href="<?php echo URL; ?>login/logout">Logout(<?php echo Session::get('userName'); ?>)</a></li>
                            <?php else: ?>
                                <li><a href="<?php echo URL; ?>login">Login</a></li>
                                <!--<li><a href="<?php // echo URL;   ?>map">Map</a></li>-->
                                <li><a href="<?php echo URL; ?>map/map2">Map</a></li>
                            <?php endif; ?>
                        </ul>
                    </header>
                </div>
            </div>
            <div></div>
            <div></div>
            <div></div>
        </header>   
        <div id="content">
