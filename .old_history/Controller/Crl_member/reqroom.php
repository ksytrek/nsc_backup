<?php 
session_start();
require_once("../../Model/ConnectDB.php");
require_once("../../Config/path.php");
if (isset($_GET["id"])){

    $setdb = [
        'id_code'  => $_SESSION['id_code']
    ];
    $Mgserror ="";
    $Mgssuccess = "";

    $elcheckdb = $connectDB->prepare("SELECT rooms.room_code FROM `eligibility` INNER JOIN rooms ON eligibility.room_code = rooms.room_code WHERE eligibility.std_code = :id_code ");
    $elcheckdb->execute($setdb);
    while($row = $elcheckdb->fetch(PDO::FETCH_ASSOC)){
        if($_GET['id'] == $row['room_code'] ){
            $Mgserror = "errorel";
        }
    }

    $rqcheckdb = $connectDB->prepare("SELECT rooms.room_code FROM `rqroom` INNER JOIN rooms ON rqroom.room_code = rooms.room_code WHERE rqroom.std_code = :id_code ");
    $rqcheckdb->execute($setdb);
    while($row = $rqcheckdb->fetch(PDO::FETCH_ASSOC)){
        if($_GET['id'] == $row['room_code'] ){
            $Mgserror = "errorrq";
        }
    }

    if($Mgserror == 'errorel'){
        $_SESSION['error'] = 'คุณมีสิทธิ์เข้าห้องนี้อยู่แล้ว';
        header("location:"._MEMBER."request_room.php");
    }elseif($Mgserror == 'errorrq'){
        $_SESSION['error'] = "คุณกำลังอยู่ในระหว่างรอดำเนินการอยู่แล้ว";
        header("location:"._MEMBER."request_room.php");
    }else{
         //inser
         $setInser = [
            'id_code'  => $_SESSION['id_code'],
            'gid'      => $_GET['id']
        ];

        $inser = $connectDB->prepare("INSERT INTO `rqroom` (`rq_id`, `std_code`, `room_code`, `dtime`) VALUES (NULL, :id_code, :gid , current_timestamp());");
        if($inser->execute($setInser)){
            $_SESSION['success'] = 'success';
            header("location:"._MEMBER);
        }
    }
    


    
}else{
    header("location:"._MEMBER);
}
?>