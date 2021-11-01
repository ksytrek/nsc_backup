<?php
include('../../config/connectdb.php');


if (isset($_GET['id'])) {

    $cid = $_GET['id'];
    $check_id_SQL = "SELECT `id_code` FROM `members` WHERE `id_code`=`{$cid}`";
    $check_id = Database::prepare($check_id_SQL);
    // $check_id->bindParam(":cid", $cid);
    // $check_id->execute(); #คิวรี
    if ($result = $check_id->fetch()) {
        echo "error";
    } else {
        echo "success";
    }


}
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $check_email_SQL = "SELECT e_main FROM members WHERE e_main=:email";
    try {
        $check_email = Database::prepare($check_email_SQL);
        $check_email->bindParam(":email", $email);
        $check_email->execute(); #คิวรี
        if ($result = $check_email->fetch(PDO::FETCH_ASSOC)) {
            echo "error";
        } else {
            echo "success";
        }
    } catch (PDOException $ex) {
        // echo "error";
    }
    
}

if (isset($_POST["data"])) {
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
        'e_main' => $email,
        'pass' => $pass,
        'phone' => $phone,
        'position' => $position


    ];
    $sql = "INSERT INTO `members` (`id_mem`, `id_code`, `name`, `last_name`, `e_main`, `pass`, `phone`, `position`, `stu_face`) VALUES (NULL, :id_code, :name, :last_name, :e_main, :pass, :phone, :position, '0');";
    $Inser_Member = Database::prepare($sql);
    if ($Inser_Member->execute($Inser_Member_data)) {
        echo 'ok';
    }
}
