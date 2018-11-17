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
        }while(checkIDDuplicate($comment_id,"comment_c","comment_id",$pdo) > 0);
        //image handle
        //p.s.
        //datetime format--> '2018-10-11 9:40'
        //image format --> {"images":["1","2","3"]}< -- wrong

        //test variables
        $post_id = "2677382";
        $position = 'aaa';
        $content = "this is the content....................";
        $department = "bbb";
        $created_date = date('Y-m-d h:s');
        
        $uinfo = json_decode(getuserinfo($u_id,$pdo),true);
        // var_dump($uinfo);
        // echo "1:".$uinfo[0]['education'];
        // echo "2:".$uinfo[0]['exp'];
        // $data = [$comment_id, $post_id, $position,$department,$created_date,$content, $uinfo[0]['education'], $uinfo[0]['exp']];
        // $insert = $pdo->prepare('insert into comment_c(comment_id, post_id, position, department, created_date, content, educationleveldesc, workexp) values(?,?,?,?,?,?,?,?);');
  

        // $result = array();
        // // echo $insert->execute($data);
        // if($insert->execute($data)){
        //     array_push($result,array('status'=>'ok'));
        // }else{
        //     array_push($result,array('status'=>'no'));
        // }
        // $insert->closeCursor();
        // echo json_encode($result);

    } catch(Exception $e){
        die($e->getMessage());
    }


    function getuserinfo($u_id,$pdo){
        $select = $pdo->query("select e.education_l as education, u.exp from user2 as u, education as e where u.u_id ='".$u_id."' and u.education = e.e_id;");
        $re = $select->fetchAll(PDO::FETCH_BOTH);
        $result = array();
        if($select){
            if(!empty($re[0]['education'])){
                array_push($result,array('exp'=>$re[0]['exp'],'education'=>$re[0]['education']));
            }else{
                array_push($result,array('status'=>'no'));
            }
        }else{
            array_push($result,array('status'=>'no'));
        }
        $select->closeCursor();
        return json_encode($result);
    }
?>