<?php 

include("../../../config/connectdb.php");

if(isset($_POST['key']) && $_POST['key'] == 'show_admin_info') {
    // echo "show_admin_info";

    $resultArray = array();

    try {
        $sql = "SELECT * FROM `tbadmin`";
        if($search = Database::query($sql, PDO::FETCH_ASSOC)){
            foreach($search as $row){
                array_push($resultArray, $row);
            }
            echo json_encode($resultArray);
        }
    } catch (Exception $e) {
        $err = [
            'error' => $e->getMessage()
        ];
        echo json_encode($err);
    }
}


if(isset($_POST['key']) && $_POST['key'] == 'btn-edit-save'){
    $id_admin = $_POST['id_admin'];
    $name_admin = $_POST['name_ad'];
    $pass_admin = $_POST['pass_ad'];
    $e_mail_ad = $_POST['e_emil_ad'];

    $data = [
        'id_admin' => $id_admin,
        'name_ad' => $name_admin,
        'pass_ad' => $pass_admin,
        'e_emil_ad' => $e_mail_ad
    ];
    try {
        $sql = "UPDATE `tbadmin` SET `name_ad` = :name_ad , `pass_ad` = :pass_ad , `e_emil_ad` = :e_emil_ad  WHERE `id_admin` = :id_admin;";
        $search = Database::prepare($sql);
        if($search->execute($data)){
            echo "success";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    // echo $id_admin;
}


