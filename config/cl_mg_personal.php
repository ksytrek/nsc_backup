<?php 


// include_once("./connectdb.php");


class ManagementPersonal
{
    public static function DeletePerson($dirPath,$id_mem) {


        $sql_id_code = Database::query("SELECT mm.id_code FROM `members` as mm WHERE id_mem = $id_mem;", PDO::FETCH_ASSOC)->fetch();
        $id_code = $sql_id_code['id_code'];

        $dirPathNew = $dirPath.$id_code.'/';
        try {
            ManagementPersonal::deleteDir($dirPathNew);
        } catch (Exception $e) {
            // no folder
        }
        // ManagementPersonal::deleteDir($dirPathNew);

        try {
            if(Database::query("DELETE FROM tbimage WHERE id_mem = '$id_mem'") && Database::query("DELETE FROM rqroom WHERE id_mem = '$id_mem'") && Database::query("DELETE FROM eligibility WHERE id_mem = '$id_mem'")){
                if(Database::query("SET FOREIGN_KEY_CHECKS=0; DELETE FROM `members` WHERE `members`.`id_mem` = '{$id_mem}';")){
                    echo "success";
                }
            }
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        
    }

    public static function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                @unlink($file);
            }
        }
        @rmdir($dirPath);
    }
}
