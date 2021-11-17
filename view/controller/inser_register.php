<?php 

include_once('../../config/connectdb.php');
if (isset($_POST["key"]) && $_POST["key"] == "submit-registers") {
    // echo "update";
    $cid = $_POST["cid"];
    $uname = $_POST["uname"];
    $lastname = $_POST["lastname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $position = $_POST["position"];

    $Inser_Member_data = [
        'id_code' => $cid,
        'name' => $uname,
        'last_name' => $lastname,
        'e_mail' => $email,
        'pass' => $pass,
        'phone' => $phone,
        'position' => $position
    ];
    try{
        if(Database::insert_data("members",$Inser_Member_data)){
            echo"success";
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }

}



?>