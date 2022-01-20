<?php
// include_once('./connectdb.php');
// include_once('./create_file_room.php');
// include_once('./cl_mg_personal.php');
// include_once('./cl_mg_personal.php');

class ManagementRoom
{

    public static function Create_room($path, $room_id_code, $room_num, $room_dclose,$room_open): bool
    {
        $json_arr = [
            'room_id_code' => $room_id_code,
            'room_name' => $room_num,
        ];
        $json_encode = json_encode($json_arr);


        try {
            $sql_insert_room = "INSERT INTO `rooms` (`id_room`, `room_id_code`, `room_num`, `room_fstatus`,`room_open`, `room_dclose`, `status_door`) VALUES (NULL, '$room_id_code', '$room_num', '0','$room_open', '$room_dclose', '0');";
            if (Database::query($sql_insert_room)) {
                
                // Create File ROOM
                if (CreateFileRoom::create_room($path, $room_id_code, $json_encode)) {
                    return true;
                }
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public static function DeleteRoom($path,$id_room): bool
    {

        $sql_room = Database::query("SELECT room_id_code FROM `rooms` WHERE id_room = '$id_room';", PDO::FETCH_ASSOC)->fetch();
        $name_room = $sql_room['room_id_code'];
    
        // echo $name_room;
    
        $dirPathNew = $path.$name_room.'/';
        try {
            ManagementPersonal::deleteDir($dirPathNew); 
        } catch (Exception $e) {
            // echo 'Error deleting';
        }
        
        try {
            $sql_eligibility = "DELETE FROM `eligibility` WHERE `eligibility`.`id_room` = '$id_room';";
            $sql_rqroom = "DELETE FROM rqroom WHERE id_room = '$id_room';";
            $sql_room = " SET FOREIGN_KEY_CHECKS =  0 ; DELETE FROM rooms WHERE id_room = '$id_room';";
            
            if(Database::query($sql_eligibility) || Database::query($sql_rqroom) || Database::query($sql_room)){
                return true;
            }

        } catch (Exception $th) {
            return false;
            
        }

        
    }

    public static function UpdateRoom($id_room, $room_num, $room_dclose)
    {
    }
}
