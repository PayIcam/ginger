<?php

namespace App\Payicam\Ginger;

class Applications {
    
    public static function checkApp($app_key){
        global $DB;
        
        $app_exists = current($DB->queryFirst('SELECT COUNT(*) FROM applications WHERE app_key = :app_key', array('app_key'=>$app_key)));
        if ($app_exists == 1)
            return true;
        else
            return false;
    }

}