<?php
    include('../model/image.php');
    try{
        extract($_GET);
        require_once('../conn.php');
        include('./init.php');

        //generate plan id
        do{
            $plan_id = "plan".date('Ym');
            for($i=0;$i<10;$i++){
                $plan_id.=rand(0,9);
            }
        }while(checkIDDuplicate($plan_id,"plan","plan_id",$pdo) > 0);
        //image handle
        //p.s.
        //route is json--> [{"1":"sth"},{"2":"sth"},{"3":"sth"}]
        //datetime format--> '2018-10-11 9:40'
        //image format --> {"images":["1","2","3"]}


        $fields = array('comment'=>1,'plan'=>2);
        //test variables
        $table_name = "plan";
        $id = "plan2018112953513017"; //plan id or comment id
        $img_prefix = substr($id,5,5);
        $img_inst = Images::Instance();
        $data = [$plan_id, $title, $country,$routes,$est_days,$start_date, $end_date, $requirements, $images, $uid, $created_date];
        $insert = $pdo->prepare('insert into plan(plan_id, title, country_id, routes, est_days, start_date, end_date, requirements,images, u_id, created_date) values(?,?,?,?,?,?,?,?,?,?,?);');

        if($insert){
            $result = array();
            // echo $insert->execute($data);
            if($insert->execute($data)){
                array_push($result,array('status'=>'ok'));
                //add holder record to applications table
                addApplication($plan_id, $uid, $holder,$pdo);
            }else{
                array_push($result,array('status'=>'no'));
            }
            echo json_encode($result);
        }


    } catch(Exception $e){
        die($e->getMessage());
    }




?>