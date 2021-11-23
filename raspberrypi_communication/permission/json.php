<?php

include_once('../../config/connectdb.php');

class update_permission
{
    public static function update($path): void
    {
        $resultArray = array();
        $json_txt = "";
        try {
            $sql = "SELECT * FROM `eligibility`";
            if ($show_tebelig = Database::query($sql, PDO::FETCH_ASSOC)) {
                foreach ($show_tebelig  as $row) {
                    array_push($resultArray, $row);
                }
                $json_txt =  json_encode($resultArray);
            } else {
                $json_txt =  json_encode($resultArray);
            }

            $Afile = "permission" . time() . ".json";
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

// update_permission::update();