<?php
include('../../config/connectdb.php');


if (isset($_GET['id'])) {

    $cid = $_GET['id'];
    try {
        foreach (Database::query("SELECT `id_code` FROM `members` WHERE `id_code`='{$cid}';",PDO::FETCH_ASSOC) as $row){
            if($row['id_code'] == $cid){
                echo "error";
                exit();
            }
        }
        echo "success";
    } catch (PDOException $ex) {
        $ex->getMessage();
    }

}
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    // $check_email_SQL = "SELECT e_mail FROM members WHERE e_mail=`{$email}`";
    try {
        foreach (Database::query("SELECT `e_mail` FROM members WHERE e_mail = '{$email}';",PDO::FETCH_ASSOC) as $row){
            if($row['e_mail'] == $email){
                echo "error";
                exit();
            }
        }
        echo "success";
    } catch (PDOException $ex) {
        $ex->getMessage();
    }
    
}
