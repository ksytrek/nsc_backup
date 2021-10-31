<?php
session_start();

if(!empty($_SESSION['success_Login'])){

    switch($_SESSION['success_Login']) {
        case 'Member_Login':
            header("location: ../View/Member/");
            break;
        case 'Admin_Login':
            // session_destroy();
            header("location: ../View/Admin/");
            break;
        default:
            session_start();
            session_destroy();
            header("location: ../View/Main_login");
            break;
    }
}else{
    session_start();
    session_destroy();
    header("location: ../View/Main_login");
}
?>