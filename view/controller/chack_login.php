<?php

// include_once(dirname(dirname(dirname(__FILE__))).'/config/connectdb.php');
include_once('../../config/connectdb.php');
session_start();

if (isset($_POST['key'])) {
    try {
        if (isset($_POST['email']) && $_POST['password']) {
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $row = array();
            $search_per =  Database::query("SELECT `id_mem`, `e_mail`, `pass`,`name`, `last_name` FROM `members` WHERE `e_mail` = '{$email}' AND `pass`='{$pass}';",PDO::FETCH_ASSOC);
            if($row = $search_per->fetch()){
                // echo $row['e_mail'] . " " . $row['pass'];
                $_SESSION['id_mem'] = $row['id_mem'];
                echo json_encode($row);
            }else{
                echo json_encode($row);
            }
            

        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}



            // echo realpath($_SERVER["DOCUMENT_ROOT"])."/config/connectdb.php";
            // echo $_SERVER['SERVER_NAME'].dirname(dirname(dirname($_SERVER ['PHP_SELF']))).'/connection.php';
            // echo dirname(dirname(dirname(__FILE__)))."\n";
            // echo dirname(dirname(dirname(__FILE__))).'/config/connectdb.php';
            // echo dirname(dirname(__FILE__)).'/config/connectdb.php';
            // echo dirname(__FILE__)."\n";
            // echo $_SERVER['DOCUMENT_ROOT']."\n";
            // echo $_SERVER['HTTP_HOST'].dirname($_SERVER ['PHP_SELF'])."\n";
            // echo $_SERVER['SERVER_NAME'].dirname(dirname(dirname($_SERVER ['PHP_SELF'])));