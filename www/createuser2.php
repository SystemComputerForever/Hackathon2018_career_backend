<?php
    try{
        extract($_GET);
        require_once('../conn.php');
        include('./init.php');
        //generate user id
        $user_id = date('Ym');
        $curr_num = intval(getNumofUser("user2",$pdo));
        $new_num = $curr_num;
        do{
            ++$new_num;
            $user_id.=sprintf('%014d',$new_num);
        }while(checkIDDuplicate($user_id,"user2","u_id",$pdo)>0);
        //add image field
        
        
        $sql = 'insert into user(u_id, user_name, email, phone_num, pwd, last_name, first_name, yob, gender, p_img, education, exp) values('.$user_id.', ":user_name", ":email", ":phone", ":pwd", ":lname", ":fname", ":yob", ":gender", ":p_img", ":education",":exp");';
        $insert = $pdo->prepare($sql);
        $insert->bindParam(':uid', $user_id);
        $insert->bindParam(':user_name', $u_name);
        $insert->bindParam(':email', $email);
        $insert->bindParam(':phone', $phone);
        $insert->bindparam(':pwd', $pwd);
        $insert->bindParam(':lname', $lname);
        $insert->bindParam(':fname', $fname);
        $insert->bindParam(':yob', $yob);
        $insert->bindParam(':gender', $gender);
        $insert->bindParam(':p_img', $p_img);
        $insert->bindParam(':education', $edu);
        $insert->bindParam(':exp', $exp);
        // echo $sql;

        if($insert){
            $result = array();
            // echo $insert->execute($data);
            if($insert->execute()){
                array_push($result,array('status'=>'ok'));
            }else{
                array_push($result,array('status'=>'no'));
            }
            echo json_encode($result);
        }
        echo json_encode($result);

    } catch(Exception $e){
        die($e->getMessage());
    }

?>