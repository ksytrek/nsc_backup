<?php 

 include_once('../../config/connectdb.php');

    $resultArray = array();
    $json_txt = "";
    try {
        $sql = "SELECT * FROM `eligibility`";
        if ($show_tebelig = Database::query($sql, PDO::FETCH_ASSOC)) {
            foreach ($show_tebelig  as $row) {
                array_push($resultArray, $row);
            }
            $json_txt =  json_encode($resultArray);
        }else{
            $json_txt =  json_encode($resultArray);
        }

        $myfile = fopen("permission".time().".json", "w") or die("Unable to open file!");
        if(fwrite($myfile, $json_txt)){
            echo "Permission OK";
        }
        fclose($myfile);


    } catch (Exception $e) {
        $resultArray = [
            "error" => $e->getMessage()
        ];
        echo json_encode($resultArray);
    }

?>