<?php
    try{
        extract($_GET);
        require_once('../conn.php');
        include('./init.php');
        //test variables
        $u_id = '20181100000000000012';

        
        //count comment level
        $select = $pdo->prepare('select u_id, user_name, last_name, first_name, cou.country as country, ci.name as city from country as cou, city as ci, user as u where u.u_id = :uid and u.country_id = cou.country.id and u.city_id = ci.city_id;');
        $select->bindParam(':uid',$u_id);
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_BOTH);
        $jr = array();
        if(isset($result[0]['title'])){

            $temp = array('u_id'=>$result[0]['u_id'], 'uname'=>$result[0]['user_name'], 'country'=>$result[0]['country'], 'city'=>$result[0]['city'], 'fname'=>$result[0]['first_name'], 'lname'=>$result[0]['last_name']);
            $select->closeCursor();

            //count hold
            $select = $pdo->prepare('select count(*) as posts from applications as a, user as u where a.participant_id = u.u_id and a.holder = 1 and u.u_id = :uid;');
            $select->bindParam(':uid',$u_id);
            $select->execute();
            $result2 = $select->fetchAll(PDO::FETCH_BOTH);
            $post = array('post'=>$result2[0]['posts']); //???plz test
            $select->closeCursor();
            //count join
            $select = $pdo->prepare('select count(*) as join from applications as a, user as u where a.participant_id = u.u_id and a.holder = 0 and a.acceptable = 1 and u.u_id = :uid;');
            $select->bindParam(':uid',$u_id);
            $select->execute();
            $result3 = $select->fetchAll(PDO::FETCH_BOTH);
            $join = array('join'=>$result3[0]['join']); //???plz test
            $select->closeCursor();
            //count comment
            $select = $pdo->prepare('select count(*) as comment from comment as c where c.target_uid = :uid;');
            $select->bindParam(':uid',$u_id);
            $select->execute();
            $result4 = $select->fetchAll(PDO::FETCH_BOTH);
            $join = array('comment'=>$result4[0]['comment']); //???plz test
            $select->closeCursor();

            //count comment level
            // countCommentLevel($u_id, $pdo);

            //count execellent
            $select = $pdo->query("select count('c.comment_id') as e from commentLevel as cl, comment as c where c.target_uid = :uid and c.comment_level = 1 and cl.comment_id = c.comment_level;");
            $select->bindParam(':uid',$u_id);
            $select->execute();
            $result5 = $select->fetchAll(PDO::FETCH_BOTH);
            $e = array('exc'=>$result5[0]['e']); //???plz test
            $select->closeCursor();
            //count good
            $select = $pdo->query("select count('c.comment_id') as g from commentLevel as cl, comment as c where c.target_uid = :uid and c.comment_level = 2 and cl.comment_id = c.comment_level;");
            $select->bindParam(':uid',$u_id);
            $select->execute();
            $result6 = $select->fetchAll(PDO::FETCH_BOTH);
            $e = array('good'=>$result6[0]['g']); //???plz test
            $select->closeCursor();
            //count not bad
            $select = $pdo->query("select count('c.comment_id') as n from commentLevel as cl, comment as c where c.target_uid = :uid and c.comment_level = 3 and cl.comment_id = c.comment_level;");
            $select->bindParam(':uid',$u_id);
            $select->execute();
            $result7 = $select->fetchAll(PDO::FETCH_BOTH);
            $n = array('nb'=>$result7[0]['n']); //???plz test
            $select->closeCursor();
            //count awful
            $select = $pdo->query("select count('c.comment_id') as a from commentLevel as cl, comment as c where c.target_uid = :uid and c.comment_level = 4 and cl.comment_id = c.comment_level;");
            $select->bindParam(':uid',$u_id);
            $select->execute();
            $result8 = $select->fetchAll(PDO::FETCH_BOTH);
            $a = array('awful'=>$result8[0]['a']); //???plz test
            $select->closeCursor();

            array_merge($temp,$post,$join,$comment,$exc,$good,$awful);

            array_push($jr, $temp);

        }else{
            array_push($jr, array("status"=>"no"));
        }
        
        echo json_encode($jr);

    } catch(Exception $e){
        die($e->getMessage());
    }

?>