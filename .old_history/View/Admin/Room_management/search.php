<?php 
    session_start();
    if ($_SESSION['success_Login'] != 'Admin_Login') {
        header("location: ../../../Controller/check_login.php");  
    }
    require_once('../../../Model/ConnectDB.php');


        if(isset($_POST['search'])){
            if(!empty($_POST['search']))
            {
                $_SESSION['search'] = $_POST['search'];
            }
            
        }header( "location: room_management.php" );
?>