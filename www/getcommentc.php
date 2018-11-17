<?php
    try{
        extract($_GET);
        require_once('../conn.php');
        //job post id
        $select = $pdo->query('select * from comment_c where post_id = "'.$post_id.'";');
        $result = $select->fetchAll(PDO::FETCH_BOTH);
        $jr = array();
        if(isset($result[0]['comment_id'])){
            foreach($result as $row){
                $temp = array('comment_id'=>$row['comment_id'], 'post_id'=>$row['post_id'], 'position'=>$row['position'], 'department'=>$row['department'], 'created_date'=>$row['created_date'], 'content'=>$row['content'], 'educationleveldesc'=>$row['educationleveldesc'], 'workexp'=>$row['workexp']);
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