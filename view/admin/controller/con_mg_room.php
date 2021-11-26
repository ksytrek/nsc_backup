<?php

include_once("../../../config/connectdb.php");
include_once("../../../config/create_file_room.php");
if (isset($_POST['key']) && $_POST['key'] == 'tb_mg_room') {
    // echo "NMalkjdfljeo ";
    $resultArray = array();
    try {
        $sql_room_search = "SELECT * FROM `rooms`";
        if ($show_tebelig = Database::query($sql_room_search, PDO::FETCH_ASSOC)) {
            foreach ($show_tebelig  as $row) {
                array_push($resultArray, $row);
            }
            echo json_encode($resultArray);
        } else {
            echo json_encode($resultArray);
        }
    } catch (Exception $e) {
        $resultArray = [
            "error" => $e->getMessage()
        ];
        echo json_encode($resultArray);
    }
}

include("../../../config/cl_mg_room.php");
if (isset($_POST['key']) && $_POST['key'] == 'btn_create_room') {


    $room_id_code = $_POST['room_id_code'];
    $room_name = $_POST['room_name'];
    $room_dclose = $_POST['room_dclose'];

    $pathForder = '../../../raspberrypi_communication/create_room/';

    if(ManagementRoom::Create_room($pathForder,$room_id_code,$room_name,$room_dclose)){
        echo "success";
    }else{
        echo "error: ";
    }
    

}


if(isset($_POST['key']) && $_POST['key'] == 'btn_edit_room'){
    // echo "success";
    $id_room = $_POST['id_room'];
    $room_id_code = $_POST['room_id_code'];
    $room_name = $_POST['room_name'];
    $room_dclose = $_POST['room_dclose'];

    $src = Database::query("SELECT * FROM rooms WHERE id_room = '$id_room';", PDO::FETCH_ASSOC);
    $row = $src->fetch();

    $room_fstatus = $row['room_fstatus'];

    // echo $room_fstatus ;

    // echo $room_fstatus;
    $json_arr= [
        'room_id_code' => $room_id_code,
        'room_name' => $room_name,
        'room_dclose' => $room_dclose,
        'room_fstatus' => $room_fstatus 
    ];

    $json_encode = json_encode($json_arr);
    $path = '../../../raspberrypi_communication/create_room/';

    try {
        $sql_update_room = "UPDATE `rooms` SET `room_id_code` = '$room_id_code', `room_num` = '$room_name', `room_fstatus` = '$room_fstatus', `room_dclose` = '$room_dclose', `status_door` = '1' WHERE `rooms`.`id_room` = '$id_room';";
        if (Database::query($sql_update_room)) {
            CreateFileRoom::create_room($path,$room_id_code, $json_encode);
            echo "success";
            // echo false;
        } else {
            echo "error";
        }
    } catch (Exception $e) {
        echo "error: ".$e->getMessage();
    }
}


if(isset($_POST['key']) && $_POST['key'] == ''){

}


Database::Con_delete();
