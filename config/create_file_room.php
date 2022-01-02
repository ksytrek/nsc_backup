<?php
class CreateFileRoom
{
    public static function create_room($path, $id_room, $json_encode): bool
    {
        $new_path = $path . '/' . $id_room;
        @mkdir($new_path, 0777, true);

        $path_file = $new_path . '/';
        $file_name = $id_room . ".json";

        try {
            $file_room_json = fopen($path_file . $file_name, "w") or  false;
            if (fwrite($file_room_json, $json_encode)) {
                // echo "json_Permission OK";
                // create file name link to id_room.json
                $file_link_to_json = fopen($path_file . "name_room_id.txt", "w") or false;
                if (fwrite($file_link_to_json, $file_name)) {
                    return true;
                } else {
                    return false;
                }
                fclose($file_link_to_json);
            } else {
                return false;
            }
            fclose($file_room_json);
        } catch (Exception $e) {
            return false;
        }
    }

    public static function delete_room($path, $room_id_code){

    }
}
