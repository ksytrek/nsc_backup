<?php

include_once('../../../config/connectdb.php');
include_once('../../../config/cl_mg_room.php');
include_once('../../../raspberrypi_communication/timeout/time.php');

if (isset($_POST['key']) && $_POST['key'] == 'search_room_info') {

    $id_room = $_POST['id_room'];
    $sql = "SELECT * FROM `rooms` WHERE id_room = $id_room;";
    $resultArray = array();
    try {
        // echo 'search_room_info';
        if ($show_tebelig = Database::query($sql, PDO::FETCH_ASSOC)) {
            foreach ($show_tebelig  as $row) {
                array_push($resultArray, $row);
            }
            echo json_encode($resultArray);
        } else {
            echo json_encode($resultArray);
        }
    } catch (Exception $e) {
        // echo 'errro';

        $resultArray = [
            "error" => $e->getMessage()
        ];
        echo json_encode($resultArray);
    }
}

if (isset($_POST['key']) && $_POST['key'] == 'show_tb_room_el') {
    $id_room = $_POST['id_room'];

    $sql = "SELECT mm.id_mem, mm.id_code , mm.name , mm.last_name ,el.id_eligibilty FROM `eligibility` as el INNER JOIN members as mm ON el.id_mem = mm.id_mem WHERE el.id_room = $id_room;";
    $resultArray = array();
    try {
        if ($search = Database::query($sql, PDO::FETCH_ASSOC)) {
            foreach ($search as $row) {
                array_push($resultArray, $row);
            }
            echo json_encode($resultArray);
        }
    } catch (Exception $e) {
        $error = [
            'error' => $e->getMessage()
        ];
        echo json_encode($error);
    }
}

if (isset($_POST['key']) && $_POST['key'] == 'show_tb_room_schedule') {
    $id_room = $_POST['id_room'];


    $sql = "SELECT * FROM `schedule` as sc  WHERE sc.id_room = $id_room;";
    $resultArray = array();
    try {
        if ($search = Database::query($sql, PDO::FETCH_ASSOC)) {
            foreach ($search as $row) {
                array_push($resultArray, $row);
            }
            echo json_encode($resultArray);
        }
    } catch (Exception $e) {
        $error = [
            'error' => $e->getMessage()
        ];
        echo json_encode($error);
    }
}


// show_tb_room_schedule
include('../../../config/cl_mg_personal.php');
if(isset($_POST['key']) && $_POST['key'] == 'delete-room-id'){
    // echo "Deleting";
    $id_room = $_POST['id_room'];

    // echo $id_room;
    
    $path = '../../../raspberrypi_communication/create_room/';




    if(ManagementRoom::DeleteRoom($path ,$id_room)){
        echo "success";
    }else{
        echo "error";
    }



    
}
if(isset($_POST['key']) && $_POST['key'] == 'ckick_btn_room_door'){
    // echo "success";
    $id_room = $_POST['id_room'];
    $status = $_POST['status'];
    // echo $id_room . " " . $satus;
    if($status == 0){
        // echo "ได้เปิดห้องเรียบร้อย";
        if(Database::query("UPDATE `rooms` SET `status_door` = '1' WHERE `rooms`.`id_room` = {$id_room};")){
            echo "ได้เปิดห้องเรียบร้อย";
            UpdateTimeRoom::updateTime('../../../raspberrypi_communication/timeout/');
        }
    }else{
        // echo "ได้ปิดห้องเรียบร้อย";
        if(Database::query("UPDATE `rooms` SET `status_door` = '0' WHERE `rooms`.`id_room` = {$id_room};")){
            echo "ได้ปิดไฟเรียบร้อย";
            UpdateTimeRoom::updateTime('../../../raspberrypi_communication/timeout/');
        }
    }
    
}
// if(isset($_POST['key']) && $_POST['key'] == ''){
    
// }
// if(isset($_POST['key']) && $_POST['key'] == ''){
    
// }
