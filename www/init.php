<?php
    $base_url = './';
    $e_key = 'qzg03cZ8yWS8ky3ZVpKLPRTaMjzgYLaK';
    function encodeText($en_t){
        return htmlspecialchars($en_t);
    }
    function checkIDDuplicate($id,$t_name,$field_name,$conn){
        $select = $conn->query("select count(*) from $t_name where $field_name = '$id';");
        return $select->fetch()['count(*)'];
    }
    function getNumofUser($conn){
        $select = $conn->query('select count(*) from user;');
        return $select->fetch()['count(*)'];
    }
    function getStringTime($date_time){
        return date('Y-m-d H:i:s',$date_time);
    }
    function getDateTime($string_time){
       return strtotime($str);
    }
    function addApplication($plan_id, $uid, $holder,$pdo){
        $submit_d = date('Y-m-d h:s');
        $data = [$plan_id, $uid, $submit_d, $holder];
        $insert = $pdo->prepare('insert into applications(plan_id, participant_id, submitted_date, holder) values(?,?,?,?);');

        if($insert){
            // echo $insert->execute($data);
            if($insert->execute($data)){
                return true;
            }else{
                return false;
            }
            
        }
    }
    function getCity($country_id, $pdo){
        try{
            $select = $pdo->prepare('select * from city where city_id = :cid;');
            $select->bindParam(':cid',$city_id);
            $select->execute();
            $jr = array();
            $result = $select->fetchAll(PDO::FETCH_BOTH);
            if(isset($result[0]['city_id'])){
                foreach($result as $row){
                    $temp = array('city_id'=>$row['city_id'], 'city'=>$row['name']);
                    array_push($jr, $temp);
                }
            }else{
                array_push($jr, array("status"=>"no"));
            }
    
    
            echo json_encode($jr);
        } catch(Exception $e){
            die($e->getMessage());
        }
    }

    function getCountry($country_id, $pdo){
        try{
            $select = $pdo->prepare('select * from country where country_id = :cid;');
            $select->bindParam(':cid',$country_id);
            $select->execute();
            $jr = array();
            $result = $select->fetchAll(PDO::FETCH_BOTH);
            if(isset($result[0]['country_id'])){
                foreach($result as $row){
                    $temp = array('country_id'=>$row['country_id'], 'country'=>$row['country']);
                    array_push($jr, $temp);
                }
            }else{
                array_push($jr, array("status"=>"no"));
            }
    
    
            echo json_encode($jr);
        } catch(Exception $e){
            die($e->getMessage());
        }
    }
    function countCommentLevel($u_id, $pdo){
        try{
            $data = [1,2,3,4];
            //comment table???
            $select = $pdo->prepare('select count(:level) from user as u, applications as a where u.u_id = :uid and .....................;');
            $select->bindParam(':cid',$country_id);
            $select->execute();
            $jr = array();
            $result = $select->fetchAll(PDO::FETCH_BOTH);
            if(isset($result[0]['country_id'])){
                foreach($result as $row){
                    $temp = array('country_id'=>$row['country_id'], 'country'=>$row['country']);
                    array_push($jr, $temp);
                }
            }else{
                array_push($jr, array("status"=>"no"));
            }
    
    
            echo json_encode($jr);
        } catch(Exception $e){
            die($e->getMessage());
        }
    }
?>
