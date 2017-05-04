<?php

/* $current_path = pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME);
  $current_host = pathinfo($_SERVER['REMOTE_ADDR'], PATHINFO_BASENAME);
  $the_depth = substr_count( $current_path , '/');
  //Set path to root for includes to access from anywhere
  if($current_host == '192.168.1.2')
  $pathtoroot =$_SERVER['DOCUMENT_ROOT'];
  else
  $pathtoroot ='http://localhost/SLTB/'; */

define('URL', 'http://localhost/SLTB/');

define('LIBS', 'libs/');
?>