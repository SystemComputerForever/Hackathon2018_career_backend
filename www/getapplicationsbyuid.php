<?php
    try{
        extract($_GET);
        require_once('../conn.php');
        include('./init.php');
        //test variables
        // $plan_id = 'plan2018112953513017'; no need
        $u_id = '20181100000000000012';
        $select = $pdo->prepare('select p.title as title, a.participant_id as p_id, u.p_img as img, a.submitted_date as sd from applications as a , plan as p, user as u where (a.plan_id = p.plan_id and p.u_id = :uid) and a.holder=0 and u.u_id = a.participant_id order by submitted_date;');
        $select->bindParam(':uid',$u_id);

        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_BOTH);
        $jr = array();
        if(isset($result[0]['title'])){
            foreach($result as $row){
                $temp = array('participant_id'=>$row['p_id'], 'title'=>$row['title'], 'img'=>$row['p_img'], 'sd'=>$row['sd']);
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