<?php
include_once("../../../config/connectdb.php");
include_once("../../../config/backup.php");

if (isset($_POST['backup'])) {
    $id_mem = $_POST["id_mem"];

    $row = Database::query("SELECT `id_code` FROM `members` WHERE `id_mem` = '$id_mem'", PDO::FETCH_ASSOC)->fetch();
    $id_code = $row['id_code'];

    $name = $id_code;
    $path = "../../../file_image/";
    $filename =  $path . $name;

    
    BackUpFileImage::createZip($path, $name);
    BackUpFileImage::download_images($path,$name,".zip");
}
