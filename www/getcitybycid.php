<?php
    try{
        extract($_GET);
        require_once('../conn.php');
        include('./init.php');
        getCity($country_id,$pdo);
    } catch(Exception $e){
        die($e->getMessage());
    }
    
?>