<?php
// include_once('../../config/connectdb.php');
class update_permission
{
    public static function update($path): void
    {

        try {
            $myfile = fopen(
                $path."name_permission.txt",
                "r"
            ) or die("Unable to open file!");
            unlink($path.fgets($myfile));
            // fgets($myfile);
            fclose($myfile);
        } catch (Exception $e) {
            
        }
        


        $resultArray = array();
        $json_txt = "";
        try {

            $sql = "SELECT el.* , mm.id_code , CONCAT(mm.name,' ',' ',mm.last_name) as 'full_name',rm.room_id_code, rm.room_num as 'room_name' FROM `eligibility`as el INNER JOIN members as mm ON el.id_mem = mm.id_mem INNER JOIN rooms as rm ON el.id_room = rm.id_room;";
            if ($show_tebelig = Database::query($sql, PDO::FETCH_ASSOC)) {
                foreach ($show_tebelig  as $row) {
                    array_push($resultArray, $row);
                }
                $json_txt =  json_encode($resultArray);
            } else {
                $json_txt =  json_encode($resultArray);
            }

            $Afile = "permission-" .date("H-i-s-d-m-Y",time())  . ".json";
            $myfile = fopen($path.$Afile, "w") or die("Unable to open file!");
            if (fwrite($myfile, $json_txt)) {
                echo "json_Permission OK";
            }
            fclose($myfile);


            $file_version = fopen($path."name_permission.txt", "w") or die("Unable to open file!");
            if (fwrite($file_version, $Afile)) {
                echo "name_Permission OK";
            }
            fclose($file_version);
        } catch (Exception $e) {
            $resultArray = [
                "error" => $e->getMessage()
            ];
            echo json_encode($resultArray);
        }
    }
}
