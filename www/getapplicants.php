<?php
    try{
        require_once('../conn.php');
        include('./init.php');

        $data = ['plan_id','title','country_id','routes','est_days','start_date','end_date','requirements','images','u_id','country'];

        $select = $pdo->query("select * from plan as p, country as c where p.country_id = c.country_id order by created_date desc;");

        $jr = array();
        // var_dump($select->fetchAll(PDO::FETCH_BOTH));
        $result = $select->fetchAll(PDO::FETCH_BOTH);
        if(isset($result[0]['plan_id'])){
            foreach($result as $row){
                $temp = array();
                for($i = 0; $i < sizeof($data); $i++){
                    $temp[$data[$i]] = $row[$data[$i]];
                }
                array_push($jr, $temp);
            }
        }else{
            array_push($jr, array("status"=>"no"));
        }
        echo json_encode($jr);
        $select->closeCursor();
    } catch(PDOException $e){
        die($e->getMessage());
    }

?>