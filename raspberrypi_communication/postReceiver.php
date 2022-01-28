
<?php

    $zip = new ZipArchive;
    $face_dir = '../file_image/';
    $model_dir = 'model/';
    $permission_dir = 'permission/';
    $time_out_dir = 'timeout/';

    include_once('../config/connectdb.php');

    //get list for capture
    if(isset($_POST['key']) && $_POST['key'] == 'list_capture')
    {
        $search = Database::query("SELECT * FROM `members` WHERE `stu_face` = 0;", PDO::FETCH_ASSOC)->fetchAll();
        echo json_encode($search);
    }

    //recieve log
    if(isset($_POST['key']) && $_POST['key'] == 'log')
    {
        echo "log";
        $data = [
            'id_mem' => $_POST["id_mem"],
            'id_code' => $_POST["id_code"],
            'full_name' => $_POST["full_name"],
            'id_room' => $_POST["id_room"], 
            'room_name' => $_POST["room_name"],
            'time_stamp' => $_POST["time_stamp"]
        ];
    
        if(Database::insert_data('schedule',$data)){
            echo "OK!";
        }
    }



    //recieve file zip of img
    if(isset($_FILES["file"]))
    {
        
        echo $_FILES["file"]["name"];

        // Unzip file of img to specific folder
        $zip->open($_FILES["file"]["tmp_name"]);
        $zip->extractTo($face_dir);
        $zip->close();
    }

    //recieve model 
    if(isset($_FILES["file_model"]))
    {
        if(!is_dir($model_dir)){
            mkdir($model_dir);
        }
        
        echo $_FILES["file_model"]["name"];

        //move model to specific folder
        $path = $model_dir.basename($_FILES["file_model"]["name"]);
        move_uploaded_file($_FILES["file_model"]["tmp_name"],$path);
    }

    //recieve permission 
    if(isset($_FILES["file_permission"]))
    {
        if(!is_dir($permission_dir)){
            mkdir($permission_dir);
        }
        
        echo $_FILES["file_permission"]["name"];

        //move model to specific folder
        $path = $permission_dir.basename($_FILES["file_permission"]["name"]);
        move_uploaded_file($_FILES["file_permission"]["tmp_name"],$path);
    }


        
    // zip files for admin to download
    if(isset($_POST['key']) && $_POST['key'] == 'zip_files')
    {
        if(!is_dir($face_dir)){
            mkdir($face_dir);
        }
        // Get real path for our folder
        $rootPath = realpath($face_dir);

        // Initialize archive object
        $zip->open('face.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }
        // Zip archive will be created only after closing object
        $zip->close();
    }
    
    //checking lastest model from a txt file
    if(isset($_POST['key']) && $_POST['key'] == 'check_latest_model')
    {    
        $file_txt = "namemodel.txt";
        if (file_exists($model_dir.$file_txt)) {
            $myfile = fopen($model_dir.$file_txt, "r") or die("Unable to open file!");
            echo fread($myfile,filesize($model_dir.$file_txt));
            fclose($myfile);
        } else {
            echo 0;
        }
    }

    //checking lastest permission from a txt file
    if(isset($_POST['key']) && $_POST['key'] == 'check_latest_permission')
    {
        $file_txt = "name_permission.txt";
        if (file_exists($permission_dir.$file_txt)) {
            $myfile = fopen($permission_dir.$file_txt, "r") or die("Unable to open file!");
            echo fread($myfile,filesize($permission_dir.$file_txt));
            fclose($myfile);
        } else {
            echo 0;
        }
    }  

    //checkinng lastest time_out from a txt file
    if(isset($_POST['key']) && $_POST['key'] == 'check_latest_time')
    {
        $file_txt = "name_roomstatus.txt";
        if (file_exists($time_out_dir.$file_txt)) {
            $myfile = fopen($time_out_dir.$file_txt, "r") or die("Unable to open file!");
            echo fread($myfile,filesize($time_out_dir.$file_txt));
            fclose($myfile);
        } else {
            echo 0;
        }
    }   




    if(isset($_POST['key']) && $_POST['key'] == 'insert_sc') {

        $id_code = $_POST['id_code'];
        $id_mem = $_POST["id_mem"];

        // 







    }





    
?>