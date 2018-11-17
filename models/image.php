<?php
class Images{

    public static function Instance(){
        static $instance = null;
        if($instance === null){
            $instance = new Images();
        }
        return $instance;
    }
    private function __construct(){}
    public static function changeFileName($u_id, $plan_id){

    }
    public static function encodeImage(){

    }
    public static function decodeImage(){
        
    }

}

?>