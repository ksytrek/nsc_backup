<?php

// include_once(dirname(dirname(dirname(__FILE__))).'/config/connectdb.php');
include_once('../../config/connectdb.php');
session_start();

if (isset($_POST['key']) && $_POST['key'] == 'submit_per') {
    try {
        if (isset($_POST['email']) && $_POST['password']) {
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $row = array();
            $search_per =  Database::query("SELECT `id_mem`, `e_mail`, `pass`,`name`, `last_name` FROM `members` WHERE `e_mail` = '{$email}' AND `pass`='{$pass}';",PDO::FETCH_ASSOC);
            if($row = $search_per->fetch()){
                // echo $row['e_mail'] . " " . $row['pass'];
                $_SESSION['id_mem'] = $row['id_mem'];
                $_SESSION["key_login"] = "personal";
                echo json_encode($row);
            }else{
                echo json_encode($row);
            }
            

        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}