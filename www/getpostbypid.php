<?php
    try{
        extract($_GET);
        require_once('../conn.php');

        $select = $pdo->prepare('select * from jobpost where id = :pid order by date desc;');
        $select->bindParam(':pid',$p_id);
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_BOTH);

        $jr = array();
        if(isset($result[0]['id'])){
            foreach($result as $row){
                $temp = array('post_id'=>strval($row['id']), 'jobtitle'=>$row['jobtitle'], 'experience'=>$row['experience'], 'salary'=>$row['salary'], 'skills'=>$row['skills'], 'displayname'=>$row['displayname'], 'shortdescription'=>$row['shortdescription'], 'fielddesc'=>$row['fielddesc'], 'subfielddesc'=>$row['subfielddesc'], 'industrydesc'=>$row['industrydesc'],'minexp'=>$row['minexp'],'maxexp'=>$row['maxexp'],'date'=>$row['date'],'education'=>$row['education'],'managerialleveldesc'=>$row['managerialleveldesc']);
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