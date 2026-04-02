<?php

namespace Debug;

class Debug{
    public static function log($message)
    {
        echo '<pre>';
            print_r($message);
        echo '</pre>';
        die();
    }
}
