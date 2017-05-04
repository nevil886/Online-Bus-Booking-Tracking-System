<?php

class Sendsms extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
                
########################################################
# Login information for the SMS Gateway
########################################################

        $this->ozeki_user = "admin";
        $this->ozeki_password = "sltb@admin";
        $this->ozeki_url = "http://127.0.0.1:9501/api?";
########################################################
    }

    function error() {
        require 'controllers/error.php';
        $controller = new Error();
        $controller->index('Sorry ...! You can not Accsess This Page');
        exit();
    }

    /*
     * View Bus pages.
     */

    function index() {
########################################################
# GET data from sendsms.html
########################################################

        if (!isset($_POST['submit']))
            $this->error();

        $phonenum = $_POST['recipient'];
        $message = $_POST['message'];
        $debug = true;

        echo $this->ozekiSend($phonenum, $message, $debug);
    }

    function sendSMS($phonenum, $message) {
        
        $phonenum = $phonenum;
        $message = $message;
        $debug = true;
        
        return $this->ozekiSend($phonenum, $message, $debug);
    }

########################################################
# Functions used to send the SMS message
########################################################

    function httpRequest($url) {
        $pattern = "/http...([0-9a-zA-Z-.]*).([0-9]*).(.*)/";
        preg_match($pattern, $url, $args);
        $in = "";
        $fp = fsockopen("$args[1]", $args[2], $errno, $errstr, 30);
        if (!$fp) {
            return("$errstr ($errno)");
        } else {
            $out = "GET /$args[3] HTTP/1.1\r\n";
            $out .= "Host: $args[1]:$args[2]\r\n";
            $out .= "User-agent: Ozeki PHP client\r\n";
            $out .= "Accept: */*\r\n";
            $out .= "Connection: Close\r\n\r\n";

            fwrite($fp, $out);
            while (!feof($fp)) {
                $in.=fgets($fp, 128);
            }
        }
        fclose($fp);
        return($in);
    }

    function ozekiSend($phone, $msg, $debug = false) {
        //global $ozeki_user, $ozeki_password, $ozeki_url;

        $url = 'username=' . $this->ozeki_user;
        $url.= '&password=' . $this->ozeki_password;
        $url.= '&action=sendmessage';
        $url.= '&messagetype=SMS:TEXT';
        $url.= '&recipient=' . urlencode($phone);
        $url.= '&messagedata=' . urlencode($msg);

        $urltouse = $this->ozeki_url . $url;
        if ($debug) {
            echo "Request: <br>$urltouse<br><br>";
        }

        //Open the URL to send the message
        $response = $this->httpRequest($urltouse);
        if ($debug) {
            echo "Response: <br><pre>" .
            str_replace(array("<", ">"), array("&lt;", "&gt;"), $response) .
            "</pre><br>";
        }

        return($response);
    }

}

?>
