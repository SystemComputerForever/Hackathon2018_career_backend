<?php
    //uid = target_uid or from_uid
    try{
        extract($_GET);
        require_once('../conn.php');
        $select = $pdo->prepare('select * from comment where target_id = :uid or from_id = :uid;');
        $select->bindParam(':uid',$uid);
        $select->execute();
        $jr = array();
        $result = $select->fetchAll(PDO::FETCH_BOTH);
        $data = ['comment_id', 'target_id', 'plan_id', 'from_uid','msg', 'comment_level'];
        if(isset($result[0]['comment_id'])){
            foreach($result as $row){
                $temp = array();
                for($i = 0; $i < sizeof($data); $i++){
                    $temp[$data[$i]] = $row[$data[$i]];
                }
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