<?php
    try{
        extract($_GET);
        require_once('../conn.php');
        include('./init.php');
        //test variables
        $uid = '20181100000000000003';
        $plan_id = 'plan2018112953513017';
        $holder = 0;
        $result = array();
        if(addApplication($plan_id,$uid, $holder, $pdo)){
            
            array_push($result,array('status'=>'ok'));
        }else{
            array_push($result,array('status'=>'no'));
        }
        echo json_encode($result);
        
 
    } catch(Exception $e){
        die($e->getMessage());
    }

?>