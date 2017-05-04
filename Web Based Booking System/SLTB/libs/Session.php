<?php

class Session {

    public static function init() {
        @session_start();
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        if (isset($_SESSION[$key]))
            return $_SESSION[$key];
    }

    public static function deset($key) {
        unset($_SESSION[$key]);
        //session_destroy();
    }

    public static function destroy() {
        //unset($_SESSION);
        session_destroy();
    }

    public static function set_cookie($value) {
        setcookie("TestCookie", $value,time()+5);
    }

    public static function get_cookie($value) {
        if (isset($_COOKIE["TestCookie"]))
            return $_COOKIE["TestCookie"];
        else
            return 'expire';
    }

}

?>
