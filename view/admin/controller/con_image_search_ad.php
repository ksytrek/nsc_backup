<?php 
include("../../../config/connectdb.php");
include("../../../config/backup.php");
if(isset($_POST['key']) && $_POST['key'] == 'backup_img_person'){
    // echo 'OK';
    $id_mem = $_POST["id_mem"];

    $row = Database::query("SELECT `id_code` FROM `members` WHERE `id_mem` = '$id_mem'", PDO::FETCH_ASSOC)->fetch();
    $id_code = $row['id_code'];
    // echo $id_code;

    $name = $id_code;
    $path = "../../../file_image/";
    $filename =  $path . $name;
    BackUpFileImage::createZip($path, $name);
    BackUpFileImage::download_images($path,$name,".zip");

}

if(isset($_POST['key']) && $_POST['key'] == 'select_delete_image'){
    $id_tbimage = $_POST["id_tbimage"];
    foreach($id_tbimage as $list){
        $sql_tb_image = "SELECT * FROM `tbimage` WHERE id_tbimage= '$list';";
        $data_tb_image = Database::query($sql_tb_image,PDO::FETCH_ASSOC)->fetch();

        $path = $data_tb_image['path_image'];
        $name = $data_tb_image['name_image'];

        // echo $path." ".$name;
        $pathfilename = $path.$name;
        if(unlink('../../../'.$pathfilename)){
            $sql_delete_tb_image = "DELETE FROM `tbimage` WHERE `tbimage`.`id_tbimage` = '$list';";
            if(Database::query($sql_delete_tb_image)){
                echo "File image Delete OK";
            }
        }else{
            echo "File image Delete flash error";
        }
        // echo $list." ".$id_room. " ";
        // $sql = "DELETE FROM `eligibility` WHERE `eligibility`.`id_eligibilty` = '{$list}';";
        // if(Database::query($sql)){
        //     // echo count($id_eligibilty);
        // }
        // echo $data_tb_image['name_image'];
    } 
}

if(isset($_POST['key']) && $_POST['key'] == 'update_show_image'){
    // echo 'update_show_image';
    $id_mem = $_POST['id_mem'];

    $sql_tb_image_count= "SELECT COUNT(*) as `count` FROM `tbimage` WHERE id_mem = '$id_mem';";
    $row_tb_image_count = Database::query($sql_tb_image_count,PDO::FETCH_ASSOC)->fetch();

    if($row_tb_image_count['count'] == 0){
        Database::query("UPDATE `members` SET `stu_face` = '0' WHERE `members`.`id_mem` = '$id_mem';");
    }

    $resultArray = array();
    try {
        $sql_tb_image_search = "SELECT * FROM `tbimage` WHERE tbimage.id_mem = {$id_mem};";
        if ($show_tebelig = Database::query($sql_tb_image_search, PDO::FETCH_ASSOC)) {
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




?>