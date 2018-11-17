<?php
    try{
    require_once('../conn.php');
    $select = $pdo->query('select * from jobpost;');
    // echo 'rows: '.$select->rowCount();
    $jr = array();
    if($select->rowCount() > 0){
        foreach($select->fetchAll(PDO::FETCH_BOTH) as $row){
            $temp = array('post_id'=>$row['id'], 'jobtitle'=>$row['jobtitle'],'experience'=>$row['experience'],'salary'=>$row['salary'],'skills'=>$row['skills'],'displayname'=>$row['displayname'],'shortdescription'=>$row['shortdescription'],'fielddesc'=>$row['fielddesc'],'subfielddesc'=>$row['subfielddesc'],'industrydesc'=>$row['industrydesc'],'minexp'=>$row['minexp'],'maxexp'=>$row['maxexp'],'date'=>$row['date'],'education'=>$row['education'],'managerialleveldesc'=>$row['managerialleveldesc']);
            array_push($jr, $temp);
        }
    }
    $select->closeCursor();
    echo json_encode($jr);
    } catch(Exception $e){
        die($e->getMessage());
    }
    
?>