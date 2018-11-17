<?php
    try{
        extract($_GET);
        require_once('../conn.php');
        include('./init.php');
        //test variables
        $acceptable = true;
        $participant_id = '20181100000000000005';
        $plan_id = 'plan2018112953513017';
        
        $update = $pdo->prepare('update applications set acceptable = :accept where plan_id = :pid and participant_id = :participant_id and holder = 0;');
        $update->bindParam(':accept',$acceptable);
        $update->bindParam(':pid',$plan_id);
        $update->bindParam(':participant_id',$participant_id);

        if($update){
            $result = array();
            if($update->execute()){
                array_push($result,array('status'=>'ok'));
            }else{
                array_push($result,array('status'=>'no'));
            }
            echo json_encode($result);
        }
    } catch(Exception $e){
        die($e->getMessage());
    }

?>