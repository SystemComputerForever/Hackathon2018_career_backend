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
        $post_id = "20181100000000000005";
        $position = '20181100000000000012';
        $department = "this is the content....................";
        $created_date = date('Y-m-d h:s');
        
        $uinfo = json_decode(getuserinfo($u_id,$pdo),true);


        $data = [$comment_id, $post_id, $position,$department,$created_date,$content, $uinfo['education'], $uinfo['exp']];
        $insert = $pdo->prepare('insert into comment_c(comment_id, post_uid, position, department, created_date, content, educationleveldesc, workexp) values(?,?,?,?,?,?,?,?);');
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


    function getuserinfo($u_id,$pdo){
        $sql = "select e.education_l as education, exp from user as u, education as e where u.u_id = :uid and u.education = e.e_id;";
        $select = $pdo->prepare($sql);
        $result = array();
        if($select){
            $select->bindParam(':uid',$u_id);
            $re = $select->execute();
            if($re[0]['education']){
                array_push($result,array('exp'=>$re[0]['exp'],'education'=>$re[0]['education']));
            }else{
                array_push($result,array('status'=>'no'));
            }
        }else{
            array_push($result,array('status'=>'no'));
        }
        return json_encode($result);
    }
?>