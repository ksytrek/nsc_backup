<?php

include_once('../../../config/connectdb.php');

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


    $sql = "SELECT mm.id_mem, mm.id_code, mm.name, mm.last_name FROM `eligibility` as el INNER JOIN `members` as mm ON el.id_mem = el.id_mem WHERE el.id_room = $id_room;";
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


    $sql = "SELECT * FROM `schedule` as sc INNER JOIN members as mm ON mm.id_mem = sc.id_mem WHERE sc.id_room = $id_room;";
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
// if(isset($_POST['key']) && $_POST['key'] == ''){
    
// }
// if(isset($_POST['key']) && $_POST['key'] == ''){
    
// }
// if(isset($_POST['key']) && $_POST['key'] == ''){
    
// }
// if(isset($_POST['key']) && $_POST['key'] == ''){
    
// }
