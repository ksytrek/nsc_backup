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
            echo json_encode($resultArray);
        }
    } catch (Exception $e) {
        $resultArray = [
            "error" => $e->getMessage()
        ];
        echo json_encode($resultArray);
    }
}


if(isset($_POST['key']) && $_POST['key'] == 'el_id_room'){
    $id_room = $_POST["id_room"];
    // echo $id_room; 

    try {
        $show_tebelig = Database::query("SELECT count(*) as total  FROM `schedule`  WHERE `id_room` = '{$id_room}';", PDO::FETCH_ASSOC);
        if($row = $show_tebelig->fetch()){
            echo $row['total'];
        }else{
            echo "ยังไม่มีสิทธิ์เข้าห้อง";
        }
    } catch (Exception $e) {
            echo "error".$e->getMessage();
    }
}

?>