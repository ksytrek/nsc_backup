<?php


// include __DIR__.'/config/connectdb.php';   // ใช้ได้เฉพาะ Linux
include_once(dirname(dirname(dirname(dirname(__FILE__))))."/config/connectdb.php"); // ใช้ได้เฉพาะ Linux
// include_once('../../../config/connectdb.php');   // ใช้ได้ทั่วไป




if(isset($_POST['key']) && $_POST['key'] == 'show_tb_mg_personal'){
    // echo "success";
    $result_array = array(); 
    try {
        if($search = Database::query("SELECT id_mem,id_code, name,last_name, position, phone  FROM `members`as mm",PDO::FETCH_ASSOC)){
            // echo "success";
            foreach ($search as $row){
                array_push($result_array,$row);
            }
            echo json_encode($result_array);
        }
    } catch (Exception $e) {
        $err = [
            'error' => $e->getMessage()
        ];
        echo json_encode($err);
    }
}