<?php
    try{
        extract($_GET);
        require_once('../conn.php');
        include('./init.php');

        $select = $pdo->prepare('select * from plan where u_id = :uid order by created_date desc;');
        $select->bindParam(':uid',$u_id);
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_BOTH);
        $jr = array();
        if(isset($result[0]['title'])){
            foreach($result as $row){
                $temp = array('plan_id'=>$row['plan_id'], 'title'=>$row['title'], 'country_id'=>$row['country_id'], 'routes'=>$row['routes'], 'est_days'=>$row['est_days'], 'start_date'=>$row['start_date'], 'end_date'=>$row['end_date'], 'requirements'=>$row['requirements'], 'images'=>$row['images'], 'u_id'=>$row['u_id'],'created_date'=>$row['created_date']);
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