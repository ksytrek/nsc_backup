<?php 
include_once("../../config/connectdb.php");


class UpdateTimeRoom
{
    public static function updateTime($path){
        $resultArray = array();
        $json_txt = "";


        try {
            $myfile = fopen(
                $path."name_roomstatus.txt",
                "r"
            ) or die("Unable to open file!");
            unlink($path.fgets($myfile));
            // fgets($myfile);
            fclose($myfile);
        } catch (Exception $e) {
            
        }
        



        try {

            $sql = "SELECT * FROM `rooms`";
            if ($show_tebelig = Database::query($sql, PDO::FETCH_ASSOC)) {
                foreach ($show_tebelig  as $row) {
                    array_push($resultArray, $row);
                }
                $json_txt =  json_encode($resultArray);
            } else {
                $json_txt =  json_encode($resultArray);
            }

            $Afile = "roomstatus-" .date("H-i-s-d-m-Y",time())  . ".json";
            $myfile = fopen($path.$Afile, "w") or die("Unable to open file!");
            if (fwrite($myfile, $json_txt)) {
                // echo "json_Permission OK";
            }
            fclose($myfile);


            $file_version = fopen($path."name_roomstatus.txt", "w") or die("Unable to open file!");
            if (fwrite($file_version, $Afile)) {
                // echo "name_Permission OK";
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


?>