<?php
include_once('./connectdb.php');
include_once('./create_file_room.php');
include_once('./cl_mg_personal.php');
class ManagementRoom
{

    public static function Create_room($path, $room_id_code, $room_num, $room_dclose): bool
    {
        $json_arr = [
            'room_id_code' => $room_id_code,
            'room_name' => $room_num,
            'room_dclose' => $room_dclose,
            'room_fstatus' => '0'
        ];

        $json_encode = json_encode($json_arr);

        try {
            $sql_insert_room = "INSERT INTO `rooms` (`id_room`, `room_id_code`, `room_num`, `room_fstatus`, `room_dclose`, `status_door`) VALUES (NULL, '$room_id_code', '$room_num', '0', '$room_dclose', '0');";
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
            // echo "Deleted";
        } catch (Exception $e) {
            // echo 'Error deleting';
        }

        try {
            $sql_eligibility = "DELETE FROM `eligibility` WHERE `eligibility`.`id_room` = '$id_room';";
            $sql_rqroom = "DELETE FROM rqroom WHERE id_room = '$id_room';";
            $sql_room = "DELETE FROM rooms WHERE id_room = '$id_room';";
            
            if(Database::query($sql_eligibility) && Database::query($sql_rqroom) && Database::query($sql_room)){
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




// class File
// {
//     public static function CreateFileroom($path, $id_room, $json_encode): bool
//     {
//         $new_path = $path . '/' . $id_room;
//         mkdir($new_path, 0777, true);

//         $path_file = $new_path . '/';
//         $file_name = $id_room . ".json";

//         try {
//             $file_room_json = fopen($path_file . $file_name, "w") or  false;
//             if (fwrite($file_room_json, $json_encode)) {
//                 // echo "json_Permission OK";
//                 // create file name link to id_room.json
//                 $file_link_to_json = fopen($path_file . "name_room_id.txt", "w") or false;
//                 if (fwrite($file_link_to_json, $file_name)) {
//                     return true;
//                 } else {
//                     return false;
//                 }
//                 fclose($file_link_to_json);
//             } else {
//                 return false;
//             }
//             fclose($file_room_json);
//         } catch (Exception $e) {
//             return false;
//         }
//     }
// }
