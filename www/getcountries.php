<?php
    try{
    require_once('../conn.php');
    $select = $pdo->query('select * from country;');
    // echo 'rows: '.$select->rowCount();
    $jr = array();
    if($select->rowCount() > 0){
        foreach($select->fetchAll(PDO::FETCH_BOTH) as $row){
            $temp = array('country_id'=>$row['country_id'], 'country'=>$row['country']);
            array_push($jr, $temp);
        }
    }
    $select->closeCursor();
    echo json_encode($jr);
    } catch(Exception $e){
        die($e->getMessage());
    }
    
?>