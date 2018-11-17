<?php
    //update last name, first name, country, city
    try{
        extract($_GET);
        require_once('../conn.php');
        include('./init.php');

        
        $data = [$user_id, $lname, $fname,$coid,$ctid];
        // $pdo->prepare('insert into user(u_id, user_name, email, phone_num, pwd, last_name, first_name, yob, gender, country_id, city_id) values(:uid, :user_name, :email, :phone, :pwd, :lname, :fname, :yob, :gender, :country, :city);');
        // $pdo->prepare('insert into user(u_id, user_name, email, phone_num, pwd, last_name, first_name, yob, gender, country_id, city_id) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
        // $sql = 'insert into user(u_id, user_name, email, phone_num, pwd, last_name, first_name, yob, gender, country_id, city_id) values('.$user_id.', '.'a user'.', encode(\'a@a.com\','.$e_key.'), encode(\'11111111\','.$e_key.'), encode(\'test1234\','.$e_key.'), '..', '..', '..', '..', '..', '..')';
        $sql = 'insert into user(u_id, user_name, email, phone_num, pwd, last_name, first_name, yob, gender, country_id, city_id) values('.$user_id.', "a user", encode(\'a@a.com\',"'.$e_key.'"), encode(\'11111111\',"'.$e_key.'"), encode(\'test1234\',"'.$e_key.'"), \'a\', \'a\', \'1999\', 0, \'86\', \'30\');';

        echo $sql;
        $pdo->query($sql);
        $result = array();
        if(getNumofUser($pdo)>$curr_num){
            array_push($result,array('status'=>'ok'));
        }else{
            array_push($result,array('status'=>'no'));
        }
        echo json_encode($result);
        // $pdo->bindParam(':uid', $user_id);
        // $pdo->bindParam(':user_name', $u_name);
        // $pdo->bindParam(':email', $email);
        // $pdo->bindParam(':phone', $phone);
        // $pdo->bindParam(':lname', $lname);
        // $pdo->bindParam(':fname', $fname);
        // $pdo->bindParam(':yob', $yob);
        // $pdo->bindParam(':gender', $gender);
        // $pdo->bindParam(':country', $country);
        // $pdo->bindParam(':city', $city);
    } catch(Exception $e){
        die($e->getMessage());
    }

?>