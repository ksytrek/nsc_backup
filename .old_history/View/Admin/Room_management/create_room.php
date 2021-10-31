
<?php
 session_start();
 if ($_SESSION['success_Login'] != 'Admin_Login') {
     header("location: ../../../Controller/check_login.php");  
 }
 require_once('../../../Model/ConnectDB.php');

//Create Room
    if(isset($_POST['btn_createRoom_submit']) && $_POST['c_code']!='' && $_POST['c_num']!='' && is_numeric($_POST['c_num']) && is_numeric($_POST['c_code'])){
        $room_code;$room_code;
        $room_code = strtolower($_POST['c_code']);
        $room_num = strtolower($_POST['c_num']);
         try{

            $where_room_data = [
                'room_code'   => $room_code,
                'room_num'    => $room_num,
            ];

            $where_room = $connectDB->prepare("SELECT * FROM `rooms` WHERE `room_code`=:room_code AND `room_num`=:room_num");
            $where_room->execute($where_room_data);
            $row = $where_room->fetch(PDO::FETCH_ASSOC);

            if(empty($row['room_num']) &&empty($row['room_code'])){
                $Success = strtolower("success");
            }else{
                ?><script>
                alert("Can't create room");
                window.history.back();
                </script>
                <?php
            }   

        }catch(PDOException $e){
            $MsgError = "DataBase ERROR ".$e->getMessage();
        }

        if(isset($Success) && $Success == "success"){
            $Insert_data= $connectDB->prepare("INSERT INTO rooms (room_code, room_num)
                    VALUES (:room_code, :room_num)");
            //$Inser_Member->execute($data_register);
            try{
                if($Insert_data->execute($where_room_data))
            {  
                $_SESSION['success'] = "REGISTER Success........";
                $Success = null;
                $closeDB = 'Cancel';
                ?><script>
                    window.history.back();
                </script>
                <?php
                $_SESSION['last_modified_n'] = $room_num;
                $_SESSION['last_modified_c'] = $room_code;
            }
            }
            catch(PDOException $e)
            {
                ?><script>
                    alert("Can't create room");
                    window.history.back();
                </script>
                <?php
            }
            
        }
    }else{
        ?><script>
        alert("only number can be input");
        window.history.back();
        </script>
        <?php
    }  
    ?>