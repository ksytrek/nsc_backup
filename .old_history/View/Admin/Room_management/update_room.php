<?php 
    session_start();
    if ($_SESSION['success_Login'] != 'Admin_Login') {
        header("location: ../../../Controller/check_login.php");  
    }
    require_once('../../../Model/ConnectDB.php');

        if(isset($_POST['submit_update']) && isset($_POST['u_code'])){
            $code = $_POST['u_code'];
            $num = $_POST['u_num'];
            echo $code;
            echo $num;
            $update_room = $connectDB->prepare("UPDATE rooms SET room_code=$code, room_num=$num WHERE room_code=$code");
            $update_room->execute();
            $_SESSION['last_modified_n'] = $num;
            $_SESSION['last_modified_c'] = $code;
        }header( "location: room_management.php" );

    ?>