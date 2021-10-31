<?php

    $host = "localhost";
    $uname = "nsc";
    $pass = "!nsc2022";
    $TableDB = "face_detection";

    try {
        // $connectDB = new PDO("mysql:host={$host};dbname={$TableDB}",$uname); //กรณีไม่มี password
        $connectDB = new PDO("mysql:host={$host};dbname={$TableDB}",$uname,$pass);  // กรณีมี password
        $connectDB->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connect Error <br> ".$e->getMessage();
        
    }
    
    
//    $host = "site.se";
//    $uname = "site_admin";
//    $pass = "somphol2543";
//    $TableDB = "facedetection";
//
//    try {
//        //$connectDB = new PDO("mysql:host={$host};dbname={$TableDB}",$uname); //กรณีไม่มี password
//        $connectDB = new PDO("mysql:host={$host};dbname={$TableDB}",$uname,$pass);  // กรณีมี password
//        $connectDB->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//    } catch (PDOException $e) {
//        echo "Connect Error <br> ".$e->getMessage();
//    }
//    

?>