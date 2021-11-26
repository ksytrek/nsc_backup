<?php 

// include(dirname(dirname(dirname(__FILE__))));
include_once(dirname(dirname(dirname(dirname(__FILE__))))."/config/connectdb.php"); // ใช้ได้เฉพาะ Linux

if(isset($_POST['key']) && $_POST['key'] == 'DataTable_on_face'){

    $resultArray = array();
    $sql ="SELECT id_mem, id_code,name,last_name,position FROM `members` WHERE stu_face = 0";
    if($search = Database::query($sql,PDO::FETCH_ASSOC)){
        foreach($search as $row){
            array_push($resultArray, $row);
        }
        echo json_encode($resultArray);
    }else{
        echo json_encode($resultArray);
    }

}

?>