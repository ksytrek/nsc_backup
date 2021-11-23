<?php 
// information_person_info
include("../../../config/connectdb.php");

if(isset($_POST['key']) && $_POST['key'] == 'information_person_info'){
    // echo 'information_person_info';
    $id_mem = $_POST['id_mem'];
    // echo $id_mem;
    $resultArray = array();
    try {
        $search_mem = "SELECT * FROM members WHERE id_mem = '$id_mem'";

        if ($show_tebelig = Database::query($search_mem, PDO::FETCH_ASSOC)) {
            foreach ($show_tebelig  as $row) {
                array_push($resultArray, $row);
            }
            echo json_encode($resultArray);
        }else{
            echo json_encode($resultArray);
        }
    } catch (Exception $e) {
        $resultArray = [
            "error" => $e->getMessage()
        ];
        echo json_encode($resultArray);
    }
}

if(isset($_POST["key"]) && $_POST["key"] == "btn_edit_save_person"){
    $id_mem = $_POST["id_mem"];
    $name = $_POST["name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["e_mail"];
    $phone = $_POST["phone"];
    $pass = $_POST["pass"];
    $position = $_POST["position"];

    $update = Database::prepare("UPDATE `members` SET 
                                        `name` = '{$name}', 
                                        `last_name` = '{$last_name}', 
                                        `e_mail` = '{$email}', 
                                        `pass` = '{$pass}', 
                                        `phone` = '{$phone}', 
                                        `position` = '{$position}' 
                                        WHERE `members`.`id_mem` = {$id_mem}");
    if($update->execute()){
        echo "success";
    } else{
        echo "error";
    }
}


if (isset($_POST['key']) && $_POST['key'] == 'delete_person'){
    $id_mem = $_POST['id_mem'];
    try {
        if(Database::query("SET FOREIGN_KEY_CHECKS=0; DELETE FROM `members` WHERE `members`.`id_mem` = '{$id_mem}';")){
            echo "success";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    

}

// if(isset($_GET['key']) && $_GET['key'] == 'show_tb_eligibility_person'){
    // echo "Show";
    // $id_mem = $_GET['id_mem'];
    // $resultArray_el = array();
    // try {
    //     $search_el = "SELECT * FROM eligibility WHERE id_mem = '$id_mem'";

    //     if ($search_el_ta = Database::query($search_el, PDO::FETCH_ASSOC)) {
    //         foreach ($search_el_ta  as $row) {
    //             array_push($resultArray_el, $row);
    //         }
    //         echo json_encode($resultArray_el);
    //     }else{
    //         echo json_encode($resultArray_el);
    //     }
    // } catch (Exception $e) {
    //     $resultArray_el = [
    //         "error" => $e->getMessage()
    //     ];
    //     echo json_encode($resultArray_el);
    // }
// }
