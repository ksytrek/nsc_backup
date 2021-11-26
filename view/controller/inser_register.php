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
        $sql_id_co = Database::query("SELECT COUNT(*) as 'count' FROM `members` WHERE id_code = '$cid';", PDO::FETCH_ASSOC);
        $row_count = $sql_id_co->fetch();
        
        if($row_count['count'] == 0){
            if(Database::insert_data("members",$Inser_Member_data)){
                echo"success";
            }
        }else{
            echo"error";
        }
        
    }catch(Exception $e){
        echo $e->getMessage();
    }

}



?>