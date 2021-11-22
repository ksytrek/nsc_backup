<?php 
include_once('../config/connectdb.php');

    $data = [
        'id_mem' => $value ,
        'id_room' => $value 
    ];

    if(Database::insert_data('schedule',$data)){
        echo "OK!";
    }


?>