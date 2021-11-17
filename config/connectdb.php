<?php
include_once('config.inc.php');
// include_once('config.inc.php');


class Database {
    private static $link = null ;
    private static function getLink() {
        if ( self :: $link ) {
            return self :: $link ;
        }
        self :: $link = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME.";charset=utf8", DB_USERNAME, DB_PASSWORD);
        self::$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self :: $link ;
    }

    public static function __callStatic ( $name, $args ) {
        $callback = array ( self :: getLink ( ), $name ) ;
        return call_user_func_array ( $callback , $args ) ;
    }

    
    public static function insert_data($table,$value_array){
        if($table == "rqroom"){
            $rqroom = "rqroom";
            $id_mem = "id_mem";
            $id_room = "id_room";
            $insert = self::getLink()->prepare("INSERT INTO $rqroom (`rq_id`, $id_mem, $id_room, `time_stamp`) VALUES (NULL, :id_mem, :id_room, current_timestamp());");
            return $insert->execute($value_array);
        }
        if($table == "rooms"){
            $insert = self::getLink()->prepare("INSERT INTO `rooms` (`id_room`, `room_num`, `room_fstatus`, `room_dclose`) VALUES (:id_room, :room_num, '0', :room_dclose);");
            return $insert->execute($value_array);
        }
        if($table == "members"){
            // INSERT INTO `members` (`id_mem`, `id_code`, `name`, `last_name`, `e_main`, `pass`, `phone`, `position`, `stu_face`) VALUES (NULL, '1222222', 'SOMPHOL', '333333', 'sdf', '62122710108', '0971271931', 'นักศึกษา', '0');
            $insert = self::getLink()->prepare("INSERT INTO `members` (`id_mem`, `id_code`, `name`, `last_name`, `e_mail`, `pass`, `phone`, `position`, `stu_face`) 
            VALUES (NULL, :id_code, :name, :last_name, :e_mail, :pass, :phone, :position, '0');");
            return $insert->execute($value_array);
        }
        if($table == "eligibility"){
            $insert = self::getLink()->prepare("INSERT INTO `eligibility` (`id_eligibilty`, `id_mem`, `id_room`) VALUES (NULL, :id_mem, :id_room);");
            return $insert->execute($value_array);
        }
        if($table == "tbimage"){
            $insert = self::getLink()->prepare("INSERT INTO `tbimage` (`id_tbimage`, `id_mem`, `path_image`, `name_image`) VALUES (NULL, :id_mem, :path_image, :name_image);");
            return $insert->execute($value_array);
        }
        if($table == "schedule"){
            $insert = self::getLink()->prepare(" INSERT INTO `schedule` (`id_ schedule`, `id_mem`, `id_room`, `time_stamp`) VALUES (NULL, :id_mem, :id_room, current_timestamp());");
            return $insert->execute($value_array);
        }
        return false;
    }

    public static function Con_delete(){
        self::getLink() == null;
    }

} ?>