<?php

//Config
//require 'config.php';
require 'config/paths.php';
require 'config/database.php';
require 'config/constants.php';

// Also spl_autoload_register (Take a look at it if you like)
function __autoload($class) {
    require LIBS . $class . ".php";
}

// Use an authloader !
//require 'libs/Bootstrap.php';
//require 'libs/Controller.php';
//require 'libs/Model.php';
//require 'libs/View.php';
//Library
//require 'libs/Database.php';
//require 'libs/Session.php';
//require 'libs/Hash.php';

$app = new Bootstrap();
?> 