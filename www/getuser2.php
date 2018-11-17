<?php
    try{
        extract($_GET);
        require_once('../conn.php');
        include('./init.php');
        //test variables
        $u_id = '20181100000000000012';

        
        //count comment level
        $select = $pdo->prepare('select u_id, user_name, last_name, first_name, p_img, e.education_l from education as e, user2 as u where u.u_id = :uid and u.education = e.e_id;');
        $select->bindParam(':uid',$u_id);
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_BOTH);
        $jr = array();
        if(isset($result[0]['u_id'])){

            $temp = array('u_id'=>$result[0]['u_id'], 'uname'=>$result[0]['user_name'], 'exp'=>$result[0]['exp'], 'education'=>$result[0]['education'], 'fname'=>$result[0]['first_name'], 'lname'=>$result[0]['last_name'],'email'=>$result[0]['email'],'phone'=>$result[0]['phone_num'],'img'=>$result[0]['p_img']);
            $select->closeCursor();

            array_push($jr, $temp);

        }else{
            array_push($jr, array("status"=>"no"));
        }
        
        echo json_encode($jr);

    } catch(Exception $e){
        die($e->getMessage());
    }

?>