<?php 
// $_POST['id']
// $_POST['id_Code']
// $_POST['status'] 
// sratus == 1 // Allow
// starus == 2 // Not Allow
require_once('../../Model/ConnectDB.php');
$rq_id = "";
$std_code = "";
$room_code = "";


if(isset($_POST['id']) && isset($_POST['id_Code']) && isset($_POST['status'])){
    $sratus = $_POST['status'];
    $ex = [
        'rqid' => $_POST['id'],
        'id_cod' => $_POST['id_Code']
    ];
    //ค้นหาผู้ร้องขอเข้าห้อง โดยมีเงือนไง rq_room ต้องเท่ากับค่าที่ร้องของมา
    $srcrq_room = $connectDB->prepare("SELECT * FROM `rqroom`   WHERE  rqroom.rq_id=:rqid AND rqroom.std_code=:id_cod");
    if($srcrq_room->execute($ex)){
        $row = $srcrq_room->fetch(PDO::FETCH_ASSOC);
        $rq_id = $row['rq_id'];
        $std_code = $row['std_code'];
        $room_code = $row['room_code'];
    }

    // print_r($rq_id."".$std_code."".$room_code);
    // print_r($sratus);
    // if($_POST['status'] == '1'){
    //     print_r($sratus);
    // }
    // if($_POST['status'] == '2'){
    //     print_r($sratus);
    // }


    if($_POST['status'] == '1'){
       
        //เพิ่มผู้มีสิทธิ์เข้าห้อง
        $InserEligibility = $connectDB->prepare("INSERT INTO `eligibility` (`id_ eligibility`, `std_code`, `room_code`) VALUES (NULL, '$std_code', '$room_code')");
        if($InserEligibility->execute()){
            //delete rq_room
            $deleterq_room = $connectDB->prepare("DELETE FROM `rqroom` WHERE rqroom.rq_id = $rq_id");
            if($deleterq_room->execute()){
                print_r("OK..........");
            }
        }
    }
    if($_POST['status'] == '2'){
        $deleterq_room = $connectDB->prepare("DELETE FROM `rqroom` WHERE rqroom.rq_id = $rq_id");
            if($deleterq_room->execute()){
                print_r("OK..........");
            }
    }

}
?>