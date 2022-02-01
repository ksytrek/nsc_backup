<?php

include_once("../../../config/connectdb.php");
include_once("../../../config/create_file_room.php");
include_once("../../../config/backup.php");
include_once("../../../config/cl_mg_room.php");
include_once('../../../config/cl_mg_personal.php');
// include_once("../../../raspberrypi_communication/timeout/time.php");
include_once("../../../raspberrypi_communication/permission/json.php");
include_once("../../../raspberrypi_communication/timeout/time.php");


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

if (isset($_POST['key']) && $_POST['key'] == 'btn_create_room') {


    $room_id_code = $_POST['room_id_code'];
    $room_name = $_POST['room_name'];
    $room_dclose = $_POST['room_dclose'];
    $room_open = $_POST['room_open'];

    $pathForder = '../../../raspberrypi_communication/create_room/';

    if(ManagementRoom::Create_room($pathForder,$room_id_code,$room_name,$room_dclose,$room_open)){
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
    $room_open = $_POST['room_open'];

    $src = Database::query("SELECT * FROM rooms WHERE id_room = '$id_room';", PDO::FETCH_ASSOC);
    $row = $src->fetch();

    $room_fstatus = $row['room_fstatus'];

    // echo $room_fstatus ;

    // echo $room_fstatus;
    $json_arr= [
        'room_id_code' => $room_id_code,
        'room_name' => $room_name,
        'room_dclose' => $room_dclose,
        'room_open' => $room_open,
        'room_fstatus' => $room_fstatus 
    ];

    $json_encode = json_encode($json_arr);
    $path = '../../../raspberrypi_communication/create_room/';

    try {
        $sql_update_room = "UPDATE `rooms` SET `room_id_code` = '$room_id_code', `room_num` = '$room_name', `room_fstatus` = '$room_fstatus', `room_dclose` = '$room_dclose', `room_open` = '$room_open', `status_door` = '1' WHERE `rooms`.`id_room` = '$id_room';";
        if (Database::query($sql_update_room)) {
            CreateFileRoom::create_room($path,$room_id_code, $json_encode);
            UpdateTimeRoom::updateTime('../../../raspberrypi_communication/timeout/');
            echo "success";
            // echo false;
        } else {
            echo "error";
        }
    } catch (Exception $e) {
        echo "error: ".$e->getMessage();
    }
}


if(isset($_POST['key']) && $_POST['key'] == 'download_file_room'){
    $id_room = $_POST["id_room"];

    $row = Database::query("SELECT `room_id_code` FROM `rooms` WHERE `id_room` = '$id_room'", PDO::FETCH_ASSOC)->fetch();
    $id_room = $row['room_id_code'];
    // echo $id_code;

    $name = $id_room;
    $path = "../../../raspberrypi_communication/create_room/";
    $filename =  $path . $name;
    BackUpFileImage::createZip($path, $name);
    BackUpFileImage::download_images($path,$name,".zip");
}


Database::Con_delete();
