<?php
    try{
        extract($_GET);
        require_once('../conn.php');
        include('./init.php');

        //generate plan id
        do{
            $comment_id = "comt".date('Ym');
            for($i=0;$i<10;$i++){
                $comment_id.=rand(0,9);
            }
        }while(checkIDDuplicate($comment_id,"comment","comment_id",$pdo) > 0);
        //image handle
        //p.s.
        //datetime format--> '2018-10-11 9:40'
        //image format --> {"images":["1","2","3"]}< -- wrong

        //test variables
        $target_id = "20181100000000000005";
        $plan_id = "plan2018112953513017";
        $from_id = '20181100000000000012';
        $msg = 3;
        $comment_level = '2018-11-11 9:40';
        $created_date = date('Y-m-d h:s');
        $img = '[{"/images/img1.jpg"},{"/images/img2.jpg"}]';


        $data = [$comment_id, $target_id, $plan_id,$from_id,$msg,$comment_level, $created_date];
        $insert = $pdo->prepare('insert into comment(comment_id, target_uid, plan_id, from_uid, msg, comment_level, created_date) values(?,?,?,?,?,?,?);');
        $insert->execute($data);

        $result = array();
        // echo $insert->execute($data);
        if($insert->execute($data)){
            array_push($result,array('status'=>'ok'));
        }else{
            array_push($result,array('status'=>'no'));
        }
        echo json_encode($result);

    } catch(Exception $e){
        die($e->getMessage());
    }

?>