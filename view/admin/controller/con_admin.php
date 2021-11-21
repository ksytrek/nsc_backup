<?php 
include("../../../config/connectdb.php");
if(isset($_POST['key']) && $_POST['key'] == 'tb_showroom'){
    // echo "jen";
    // $id_mem = $_POST['id_mem'];
    $resultArray = array();
    try {
        $sql_room_search = "SELECT rm.id_room , rm.room_num,rm.room_fstatus ,COUNT(el.id_room) as 'count' FROM rooms as rm LEFT JOIN eligibility as el ON rm.id_room = el.id_room GROUP BY rm.id_room;";
        if ($show_tebelig = Database::query($sql_room_search, PDO::FETCH_ASSOC)) {
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

if(isset($_POST['key']) && $_POST['key'] == 'ckick_btn_room_fstatus'){
    // echo "ckick_btn_room_fstatus";
    $id_room = $_POST['id_room'];
    $status = $_POST['status'];
    // echo $id_room . " " . $satus;
    if($status == 0){
        // echo "ได้เปิดห้องเรียบร้อย";
        if(Database::query("UPDATE `rooms` SET `room_fstatus` = '1' WHERE `rooms`.`id_room` = {$id_room};")){
            echo "ได้เปิดไฟห้องเรียบร้อย";
        }
    }else{
        // echo "ได้ปิดห้องเรียบร้อย";
        if(Database::query("UPDATE `rooms` SET `room_fstatus` = '0' WHERE `rooms`.`id_room` = {$id_room};")){
            echo "ได้ปิดไฟห้องเรียบร้อย";
        }
    }
}

if(isset($_POST['key']) && $_POST['key'] == 'show_rqroom'){
    // echo "rqroom";
    $resultArray = array();
    try {
        $sql_rqroom_search = "SELECT mm.id_code, mm.name ,mm.last_name , rm.room_num , mm.id_mem , rm.id_room FROM rqroom as rq INNER JOIN members as mm ON rq.id_mem = mm.id_mem INNER JOIN rooms as rm ON rq.id_room = rm.id_room;";
        if ($show_tebelig = Database::query($sql_rqroom_search, PDO::FETCH_ASSOC)) {
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


if (isset($_POST['key']) && $_POST['key'] == 'click_examine'){
    // echo "OK". $_POST["keyclick"]." ". $_POST["id_room"];
    $keyclick = $_POST["keyclick"];
    $id_room = $_POST["id_room"];
    $id_mem = $_POST["id_mem"];
    if($keyclick == 0){
        // 0 = fornbi ยกเลิก
        echo "cancel";
    }else{
        // 1 ยืนยัน หรือ allow
        echo "Allow";
    }
}



// if(isset($_POST['key']) && $_POST['key'] == 'el_id_room'){
//     $id_room = $_POST["id_room"];
//     // echo $id_room; 

//     try {
//         $show_tebelig = Database::query("SELECT count(*) as total  FROM `schedule`  WHERE `id_room` = '{$id_room}';", PDO::FETCH_ASSOC);
//         if($row = $show_tebelig->fetch()){
//             echo $row['total'];
//         }else{
//             echo "ยังไม่มีสิทธิ์เข้าห้อง";
//         }
//     } catch (Exception $e) {
//             echo "error".$e->getMessage();
//     }
// }


?>