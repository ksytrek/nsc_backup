<?php 
include("../../../config/connectdb.php");
if(isset($_POST['key']) && $_POST['key'] == 'tb_showroom'){
    // echo "jen";
    // $id_mem = $_POST['id_mem'];
    $resultArray = array();
    try {
        if ($show_tebelig = Database::query("SELECT * FROM `rooms` ", PDO::FETCH_ASSOC)) {
            foreach ($show_tebelig  as $row) {
                array_push($resultArray, $row);
            }
            echo json_encode($resultArray);
        }else{
            // $resultArray = [
            //     "error" => $e->getMessage()
            // ];
            echo json_encode($resultArray);
        }
    } catch (Exception $e) {
        $resultArray = [
            "error" => $e->getMessage()
        ];
        echo json_encode($resultArray);
    }




}





?>