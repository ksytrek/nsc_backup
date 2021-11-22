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
        $sql_rqroom_search = "SELECT mm.id_code, mm.name ,mm.last_name , rm.room_num , mm.id_mem , rm.id_room , rq.rq_id FROM rqroom as rq INNER JOIN members as mm ON rq.id_mem = mm.id_mem INNER JOIN rooms as rm ON rq.id_room = rm.id_room;";
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
    $rq_id = $_POST["rq_id"];
    if($keyclick == "0"){
        // 0 = fornbi ยกเลิ
        try{
            if(Database::query("DELETE FROM `rqroom` WHERE `rqroom`.`rq_id` = '{$rq_id}';")){
                echo "cancel";
            }
        }catch (Exception $e) {
            echo "An error occurred".$e->getMessage();
        }
        
    }else{
        // 1 ยืนยัน หรือ allow
        try{
            $search_rq_id = Database::query("SELECT * FROM `rqroom` WHERE rq_id = $rq_id",PDO::FETCH_ASSOC)->fetch();
            $id_room = $search_rq_id['id_room'];
            $id_mem = $search_rq_id['id_mem'];
            if(Database::query("INSERT INTO `eligibility` (`id_eligibilty`, `id_mem`, `id_room`) VALUES (NULL, '$id_mem', '$id_room');")){
                Database::query("DELETE FROM `rqroom` WHERE `rqroom`.`rq_id` = '{$rq_id}';");
                echo "OK";
            }else{
                echo "Error";
            }
        }catch (Exception $e) {
            echo "Error: ".$e->getMessage();
        }
        
    }
}

if(isset($_POST['key']) && $_POST['key'] == 'search_id_code'){
    // echo "Search";
    $id_code = $_POST['id_code'];
    $id_room = $_POST['id_room'];

    // echo $id_code;
    $resultArray = array();
    try {
        $sql = "SELECT DISTINCT mm.id_mem,rm.id_room, mm.id_code,mm.name,mm.last_name , rm.room_num FROM eligibility as el JOIN rooms as rm JOIN members as mm WHERE rm.id_room IN ('{$id_room}') AND mm.id_mem LIKE '%{$id_code}%' ORDER BY mm.id_code ASC;";
        if ($show_tebelig = Database::query($sql, PDO::FETCH_ASSOC)) {
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





// if(isset($_POST['key']) && $_POST['key'] == "show_tb_eligibility"){

//     $resultArray = array();
//     try {
//         $sql_rqroom_search = "SELECT mm.id_code, mm.name ,mm.last_name , rm.room_num , mm.id_mem , rm.id_room , rq.rq_id FROM rqroom as rq INNER JOIN members as mm ON rq.id_mem = mm.id_mem INNER JOIN rooms as rm ON rq.id_room = rm.id_room;";
//         if ($show_tebelig = Database::query($sql_rqroom_search, PDO::FETCH_ASSOC)) {
//             foreach ($show_tebelig  as $row) {
//                 array_push($resultArray, $row);
//             }
//             echo json_encode($resultArray);
//         }else{
//             echo json_encode($resultArray);
//         }
//     } catch (Exception $e) {
//         $resultArray = [
//             "error" => $e->getMessage()
//         ];
//         echo json_encode($resultArray);
//     }

// }

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