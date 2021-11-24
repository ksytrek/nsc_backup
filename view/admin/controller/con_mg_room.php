<?php

include("../../../config/connectdb.php");
include("../../../config/create_file_room.php");
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
    $id_room = $_POST['id_room'];
    $room_name = $_POST['room_name'];
    $room_dclose = $_POST['room_dclose'];

    $json_arr= [
        'id_room' => $id_room,
        'room_name' => $room_name,
        'room_dclose' => $room_dclose,
        'room_fstatus' => '0'
    ];


    $json_encode = json_encode($json_arr);
    $path = '../../../raspberrypi_communication/create_room/';

    try {
        $sql_insert_room = "INSERT INTO `rooms` (`id_room`, `room_num`, `room_fstatus`, `room_dclose`) VALUES ('{$id_room}', '{$room_name}', '0', '{$room_dclose}');";
        if (Database::query($sql_insert_room)) {
            CreateFileRoom::create_room($path,$id_room, $json_encode);
            echo "success";
        } else {
            echo "error";
        }
    } catch (Exception $e) {
        echo "error: ";
    }
}


if(isset($_POST['key']) && $_POST['key'] == 'btn_edit_room'){
    // echo "success";
    $id_room = $_POST['id_room'];
    $room_name = $_POST['room_name'];
    $room_dclose = $_POST['room_dclose'];

    $src = Database::query("SELECT * FROM rooms WHERE id_room = '$id_room';", PDO::FETCH_ASSOC);
    $row = $src->fetch();

    $room_fstatus = $row['room_fstatus'];

    // echo $room_fstatus;
    $json_arr= [
        'id_room' => $id_room,
        'room_name' => $room_name,
        'room_dclose' => $room_dclose,
        'room_fstatus' => $room_fstatus
    ];

    $json_encode = json_encode($json_arr);
    $path = '../../../raspberrypi_communication/create_room/';

    try {
        $sql_update_room = "UPDATE `rooms` SET `room_num` = '$room_name', `room_fstatus` = '$room_fstatus', `room_dclose` = '$room_dclose' WHERE `rooms`.`id_room` = '$id_room';";
        if (Database::query($sql_update_room)) {
            CreateFileRoom::create_room($path,$id_room, $json_encode);
            echo "success";
            // echo false;
        } else {
            echo "error";
        }
    } catch (Exception $e) {
        echo "error: ";
    }
}


Database::Con_delete();
