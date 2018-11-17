<?php
    try{
        extract($_GET);
        require_once('../conn.php');
        include('./init.php');
        //test variables
        $plan_id = 'plan2018112953513017';
        $u_id = '20181100000000000005';

        $select = $pdo->prepare('select u.u_id as u_id, u.user_name as user_name from applications as a, user as u where a.plan_id = :plan_id and u.u_id = a.participant_id and participant_id is not :u_id or (a.holder = 0 and a.acceptable = 1) or a.holder = 1;');
        $select->bindParam(':uid',$u_id);
        $select->bindParam(':plan_id',$plan_id);
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_BOTH);
        $jr = array();
        if(isset($result[0]['u_id'])){
            foreach($result as $row){
                $temp = array('u_id'=>$row['u_id'], 'u_name'=>$row['user_name']);
                array_push($jr, $temp);
            }
        }else{
            array_push($jr, array("status"=>"no"));
        }


        echo json_encode($jr);

    } catch(Exception $e){
        die($e->getMessage());
    }

?>