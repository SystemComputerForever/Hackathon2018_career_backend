<?php
    try{
        extract($_GET);
        require_once('../conn.php');
        $eduf= ['','Bachelor Degree','Diploma / Certificate','Master Degree'];
        
        $condition = '';
        //test variable
        // $jobtitle = "";
        // $exp = "2"; //0-2 only
        // $minsalary = '100';
        // $maxsalary = '200';
        // $edu = 1;
        $isfull = false;
        if(!empty($jobtitle)){
            $condition.= "jobtitle like '%".$jobtitle."%' and ";
            $isfull = true;
        }
        // echo "compare1:".$exp;
        if(isset($exp) && intval($exp)>-1){
            // $compare = ["=","=",">"];
            // echo "compare2:".$exp;
            $compare = '';
            if($exp ==0 || $exp ==1){
                $compare = '='.$exp;
            }else{
                $compare = '>='.$exp;
            }
            // echo $compare;
            $condition.= "SUBSTRING(minexp,1,2) ".$compare ." and ";
            $isfull = true;
        }
        if(!empty($minsalary) && !empty($maxsalary)){
            $condition.= "(salary between $minsalary and $maxsalary) and ";
            $isfull = true;
        }

        if(!empty($edu) && (intval($edu)>=1 && intval($edu)<=3)){
            $edu1 = $eduf[$edu];
            // echo "edu: ".$edu;
            $condition.= "education = ".$edu1;
            $isfull = true;
        }
        if($isfull){
            // $condition = preg_replace("/and$/", '',$condition);
            $condition = rtrim($condition, 'and ');
            echo 'select * from jobpost as j, education as e where '.$condition.' and e.education_l = j.education order by date desc;';
            $select = $pdo->prepare('select * from jobpost where '.$condition.' order by date desc;');
            
            var_dump($select);
            $select->execute();
            $result = $select->fetchAll(PDO::FETCH_BOTH);
            
            $jr = array();
            if(isset($result[0]['id'])){
                foreach($result as $row){
                    $temp = array('post_id'=>$row['id'], 'jobtitle'=>$row['jobtitle'], 'experience'=>$row['experience'], 'salary'=>$row['salary'], 'skills'=>$row['skills'], 'displayname'=>$row['displayname'], 'shortdescription'=>$row['shortdescription'], 'fielddesc'=>$row['fielddesc'], 'subfielddesc'=>$row['subfielddesc'], 'industrydesc'=>$row['industrydesc'],'minexp'=>$row['minexp'],'maxexp'=>$row['maxexp'],'date'=>$row['date'],'education'=>$row['education'],'managerialleveldesc'=>$row['managerialleveldesc']);
                    array_push($jr, $temp);
                }
            }else{
                array_push($jr, array("status"=>"no"));
            }


            echo json_encode($jr);
            $select->closeCursor();
        }else{
            echo json_encode(array("status"=>"no"));
        }
    } catch(Exception $e){
        die($e->getMessage());
    }

?>