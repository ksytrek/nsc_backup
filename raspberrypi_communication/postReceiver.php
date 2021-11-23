
<?php

    $zip = new ZipArchive;
    $face_dir = '../file_image/';
    $model_dir = 'model/';
    $permission_dir = 'permission/';
    $time_out_dir = 'timeout/';

    //recieve log
    if(isset($_POST["id_mem"]) && isset($_POST["id_room"]))
    {
        include_once('../config/connectdb.php');
        $data = [
            'id_mem' => $_POST["id_mem"],
            'id_room' => $_POST["id_room"] 
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
    if(isset($_POST['zip_files']))
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
    if(isset($_POST['check_latest_model']))
    {        
        if (file_exists($model_dir."namemodel.txt")) {
            $myfile = fopen($model_dir."namemodel.txt", "r") or die("Unable to open file!");
            echo fread($myfile,filesize($model_dir."namemodel.txt"));
            fclose($myfile);
        } else {
            echo 0;
        }
    }

    //checking lastest permission from a txt file
    if(isset($_POST['check_latest_permission']))
    {

        if (file_exists($permission_dir."name_permission.txt")) {
            $myfile = fopen($permission_dir."name_permission.txt", "r") or die("Unable to open file!");
            echo fread($myfile,filesize($permission_dir."name_permission.txt"));
            fclose($myfile);
        } else {
            echo 0;
        }
    }  

    //checkinng lastest time_out from a txt file
    if(isset($_POST['check_latest_time']))
    {

        if (file_exists($time_out_dir."time.txt")) {
            $myfile = fopen($time_out_dir."time.txt", "r") or die("Unable to open file!");
            echo fread($myfile,filesize($time_out_dir."time.txt"));
            fclose($myfile);
        } else {
            echo 0;
        }
    }
    
?>