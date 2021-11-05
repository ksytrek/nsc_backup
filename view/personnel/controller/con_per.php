<?php


include('../../../config/connectdb.php');
// include(dirname(__FILE__)."index.php");
//   \tfygh\yfugiuhojpo.php
//  /fgkhl/iuoi/hkjhj.php
// $_SERVER['hosy'].dirname(dirname(__FILE__))."kuhli.[hp";


if (isset($_POST['key']) && $_POST['key'] == "add_rq_room") {
    // echo $_POST['room_id'];
    $id_mem = $_POST['id_mem'];
    $id_room = $_POST['id_room'];

    $valu = [
        'id_mem' => $id_mem,
        'id_room' => $id_room
    ];

    $query_el = Database::query("SELECT * FROM  eligibility WHERE `id_mem`= {$id_mem} AND id_room = {$id_room};",PDO::FETCH_ASSOC);
    $query_rq = Database::query("SELECT * FROM  rqroom WHERE `id_mem`= {$id_mem} AND id_room = {$id_room};",PDO::FETCH_ASSOC);
    if($row = $query_el ->fetch()){
        echo "er_1";
        // echo "ไม่สามารถร้องขอใช้ห้องได้ เพราะมีสิทธิ์เข้าห้องแล้ว";
    }else{
        if($row = $query_rq->fetch()){
            echo "er_2";
        // echo "ไม่สามารถร้องขอใช้ห้องได้ เพราะกำลังอยู่ในช่วงพิจารณา";
        }else{
            if(Database::insert_data('rqroom', $valu)){
                echo "success";
            }else{
               echo "er_3";
                // echo "เกินข้อผิดพลาดโดยไม่ทราบสาเหตุ!";
            }
            
        }
    
    }
    
        
    
    
    // foreach ($query_el  as $row){
    //     $el_id_mem =  $row['id_mem'];
    //     $el_id_room =  $row['id_room'];
    //  }

    // if(Database::insert_data('rq_rooom', $valu)){

    // }
}



if (isset($_POST['tb_elig']) && $_POST["tb_elig"] == "tb_elig" && isset($_POST['id_mem'])) {
    $id_mem = $_POST['id_mem'];
    $resultArray = array();
    try {
        if ($show_tebelig = Database::query("SELECT rm.room_num FROM `eligibility` as el inner join `rooms` as rm on el.id_room = rm.id_room  where `id_mem` = '{$id_mem}' ORDER BY `id_eligibilty`  ASC ", PDO::FETCH_ASSOC)) {
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

// แสดงข้อมูลขอใช้ห้อง
if (isset($_POST['tb_rqroom'])&&$_POST['tb_rqroom'] == "tb_rqroom" && isset($_POST['id_mem'])) {
    $id_mem = $_POST['id_mem'];
    $resultArray = array();
    try {
        if ($show_tebelig = Database::query("SELECT rm.room_num , rq.time_stamp FROM `rqroom` as rq inner join `rooms` as rm on rq.id_room = rm.id_room  where `id_mem` = '{$id_mem}' ORDER BY `time_stamp`  ASC ", PDO::FETCH_ASSOC)) {
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


if (isset($_POST['tb_schedule']) && isset($_POST['id_mem'])) {
    
    echo "
    <tr>
        <td>sdfsdfsdf</td>
        <td>sdfsdfsdf</td>
        <td>sdfsdfsdf</td>
    </tr>
    ";
    // $id_mem = $_POST['id_mem'];
    // $resultArray = array();
    // try {
    //     if ($show_tebelig = Database::query("SELECT rm.room_num , rq.time_stamp FROM `rqroom` as rq inner join `rooms` as rm on rq.id_room = rm.id_room  where `id_men` = '{$id_mem}' ORDER BY `time_stamp`  ASC ", PDO::FETCH_ASSOC)) {
    //         foreach ($show_tebelig  as $row) {
    //             array_push($resultArray, $row);
    //         }
    //         echo json_encode($resultArray);
    //     }else{
    //         // $resultArray = [
    //         //     "error" => $e->getMessage()
    //         // ];
    //         echo json_encode($resultArray);
    //     }
    // } catch (Exception $e) {
    //     $resultArray = [
    //         "error" => $e->getMessage()
    //     ];
    //     echo json_encode($resultArray);
    // }




}


if (isset($_POST['key']) && $_POST['key'] == "information"){
    // echo "Information";

    $id_mem = $_POST['id_mem'];
    $resultArray_info = array();

    
    if($information = Database::query("SELECT * FROM members WHERE `id_mem`= {$id_mem};")){
        foreach($information as $row) {
            array_push($resultArray_info, $row);
        }
        echo json_encode($resultArray_info);
    }else{
        echo json_encode($resultArray_info);
        // echo "Error";
    }
}



if(isset($_POST["key"]) && $_POST["key"] == "btn_edit_save"){
    $id_mem = $_POST["id_mem"];
    $name = $_POST["name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    // $pass = $_POST["pass"];
    $position = $_POST["position"];

    $update = Database::prepare("UPDATE `members` SET 
                                        `name` = '{$name}', 
                                        `last_name` = '{$last_name}', 
                                        `e_mail` = '{$email}', 
                                        
                                        `phone` = '{$phone}', 
                                        `position` = '{$position}' 
                                        WHERE `members`.`id_mem` = {$id_mem}");
    if($update->execute()){
        echo "success";
    } else{
        echo "error";
    }
    // echo $id_mem,$name,$last_name,$email,$phone,$pass,$position;






    // Database::query("")
    // UPDATE `members` SET `id_code` = '1339900662225', `name` = 'SOMPHO', `last_name` = 'WIL', `e_mail` = 'std.62122710107@ubru.ac.th', `pass` = '!Somphol2543', `phone` = '0971271932', `position` = 'นักศึก' WHERE `members`.`id_mem` = 37;

}