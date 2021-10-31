<?php
    require_once('../Model/ConnectDB.php');
    require_once('../Config/path.php');
    session_start();
    
    $closeDB;
    $MsgError;
    $Success;
    
    $e_mail ;
    $pass ;
    //TEXT SQL
    // Member SQL
    $memberLogin_db_SQL = "SELECT * FROM members WHERE e_mail=:e_mail AND pass=:pass";
    // Admin Login System
    $select_admin_SQL = "SELECT * FROM `tbadmin` WHERE `e_mail_ad`=:email AND `pass_ad`=:pass";
    // Register System
    $Inser_Member_SQL = "INSERT INTO members (id_code, name, last_name, e_mail, pass, position, area_code, phone)
            VALUES (:id_code, :name, :last_name, :e_mail, :pass, :position, :area_code, :phone)";
    //Update Member
    $member_updateSQL = "UPDATE members SET name=:name, last_name=:last_name , e_mail =:e_mail, pass=:pass ,phone=:phone WHERE id_code=:id_code ";


// Member Login System
    if(isset($_POST['btn_member_Login'])){

        $e_mail = $_POST['email'];
        $pass = $_POST['pass'];

        if(empty($e_mail)){
            $MsgError = "กรุณากรอก E-Mail";
        }elseif (empty ($pass)) {
            $MsgError = "กรุณากรอก รหัสผ่านใหม่";
        }else{
            
            $db_id_code = "";
            $db_email = "";
            $db_name = "";
            $db_last_name ="";
            $db_pass ="";
            $db_phone = "";
            $db_status = "";
            
            try {
                // $memberLogin_db_SQL = "SELECT * FROM members WHERE e_mail=:e_mail AND pass=:pass";
                $memberLogin_db = $connectDB->prepare($memberLogin_db_SQL);
                $memberLogin_db->bindParam(":e_mail", $e_mail);
                $memberLogin_db->bindParam(":pass", $pass);
                $memberLogin_db->execute(); #คิวรี
                try {
                    
                    while ($row = $memberLogin_db->fetch(PDO::FETCH_ASSOC)) {
                    
                        $db_id_code = $row['id_code'];
                        $db_email = $row['e_mail'];
                        $db_name = $row['name'];
                        $db_last_name = $row['last_name'];
                        $db_pass = $row['pass'];
                        $db_phone = $row['phone'];
                        $db_status = $row['position'];
                    }
                    
                } catch (PDOException $ex) {
                    $MsgError = $ex->getMessage();
                }
                

                if ($db_email != null && $db_pass != null) {
                    
                    if ($memberLogin_db->rowCount() > 0 ) {
                        if ($e_mail == $db_email && $pass == $db_pass) {
                            
                            session_destroy();
                            session_start();
                            
                            $_SESSION['Member_Login'] = $db_email ;
                            $_SESSION['id_code'] = $db_id_code ;
                            $_SESSION['e_mail'] = $db_email ;
                            $_SESSION['name'] = $db_name ;
                            $_SESSION['last_name'] = $db_last_name ;
                            $_SESSION['pass'] = $db_pass ;
                            $_SESSION["phone"] = $db_phone;
                            $_SESSION["position"] =  $db_status;
                            

                            $_SESSION['success_Login'] = "Member_Login";
                            // header("location: ../View/");
                            $closeDB = "Cancel";
                            header("location: ./check_login.php");
                            
                             
                        } else {
                            $MsgError = "Error.......... uname != db_name Login Unset ....";
                        }
                    } else {
                        $MsgError = "ERROR............ rowCount <=0 ";
                    }
                } else {
                    
                    $MsgError = "User OR Password ไม่ถูกต้อง";
                }
                      
            } catch (PDOException  $e) {
                $MsgError = "Connection ERROR ......" .$e->getMessage();
            }
        }
    }

// Admin Login System
    if(isset($_POST['btn_admin_Login'])){
        //
        session_destroy();
        session_start();

        $e_mail_ad;$pass_ad;

        if(!empty($_POST['email']) && !empty($_POST['pass'])){
            $e_mail_ad = $_POST['email'];
            $pass_ad = $_POST['pass'];
            $Success = strtolower("success");
        }else{
            $MsgError = "กรุณากรอกข้อมูล Email หรือ Password";
        }

        // $whereTEST = true && false?"true":"false";

        $dtAdmin_Login = [
            'email' => $e_mail_ad,
            'pass'  => $pass_ad
        ];

        if(!empty($Success) && $Success == "success"){
            // $select_admin_SQL = "SELECT * FROM `tbadmin` WHERE `e_mail_ad`=:email AND `pass_ad`=:pass";
            $select_admin = $connectDB->prepare($select_admin_SQL);
            $select_admin->execute($dtAdmin_Login);
            $row = $select_admin->fetch(PDO::FETCH_ASSOC);
            if(!empty($row['e_mail_ad']) && !empty($row['pass_ad'])){
                if($e_mail_ad == $row['e_mail_ad'] && $pass_ad == $row['pass_ad']){
                    
                    
                    $_SESSION['success_Login'] = "Admin_Login";
                    $_SESSION["e_mail_ad"] = $row['e_mail_ad'];
                    $_SESSION["id_code"] = $row['id_admin'];


                    $closeDB = "Cancel";
                    header("location: ./check_login.php");

                    // header("location: ../View/Admin/");
                }
            }else{
                $MsgError = "รหัสผ่าน ไม่ถูกต้อง";
            }
        }
    }
    
// Register System
    if(isset($_POST['btn_register_submit'])){
        // ประกาศและกำหนด Value
        $id_code = " ";$position="default";$name;$last_name;$password;$e_mail;$area_code=" ";$phone;
        
        $position = strtolower($_POST['position']);
        $name = strtolower($_POST['first_name']);
        $last_name = strtolower($_POST['last_name']);
        $password = strtolower($_POST['pass_regis']);
        $e_mail = strtolower($_POST['email']);
        $area_code = strtolower("+66");
        $phone = strtolower($_POST['phone']);

        switch($position) {
            case 'student':
                $id_code = $_POST['id_student'];
                break;
            case 'professor':
                $id_code = $_POST['id_professor'];
                break;

            case 'other':
                $id_code = $_POST['id_other'];
                break;
            default:
                $MsgError = "กรุณาเลือกตำเเหน่ง";
                break;
        }

        
        // Chack ข้อมูลซ้ำกับ DataBase
        try{

            $wheredata_regis = [
                // 'name'     => $name,
                'id_code'   => $id_code,
                'e_mail'    => $e_mail,
                // 'pass'      => $password,
                // 'position'  => $position
            ];
            // $whereregis_SQL = "SELECT * FROM `members` WHERE `id_code`=:id_code or `e_mail`=:e_mail or `pass`=:pass or `position`=:position"; AND name=:name
            $whereregis_SQL = "SELECT * FROM `members` WHERE `id_code`=:id_code OR e_mail=:e_mail ";
            $where_regis = $connectDB->prepare($whereregis_SQL);
            $where_regis->execute($wheredata_regis);
            $row = $where_regis->fetch(PDO::FETCH_ASSOC);

            if(empty($row['id_code']) && empty($row['e_mail']) ){
                    $Success = strtolower("success");
                
            }else{
                $MsgError =  "ไม่สามารถ บันทึกได้";
            }   

        }catch(PDOException $e){
            $MsgError = "DataBase ERROR ".$e->getMessage();
        }
            

        // Add DataBase Inser Into
        if(isset($Success)){
            $DataInser_member = [
                'id_code'   => $id_code,
                'name'      => $name,
                'last_name' => $last_name,
                'e_mail'    => $e_mail,
                'pass'      => $password,
                'position'  => $position,
                'area_code' => $area_code,
                'phone'     => $phone
            ];

            // $Inser_Member_SQL = "INSERT INTO members (id_code, name, last_name, e_mail, pass, position, area_code, phone)
            //     VALUES (:id_code, :name, :last_name, :e_mail, :pass, :position, :area_code, :phone)";
            
            $Inser_Member = $connectDB->prepare($Inser_Member_SQL);
            if($Inser_Member->execute($DataInser_member))
            {
                
                session_destroy();
                session_start();
                $_SESSION['success'] = "REGISTER Success........";

                $Success = null;
                $closeDB = 'Cancel';
                header("location: ../View/Main_Login/");
            }
        
        }
 
    }

//Update Member
    if(isset($_POST['edit_submit'])){
        if (!empty($_POST["id_code"]) && !empty($_POST["name"]) && !empty($_POST["last_name"]) && !empty($_POST["e_mail"]) && !empty($_POST["phone"]) && !empty($_POST["position"]) && !empty($_POST["pass"]) )  {
            echo "ผ่าน";
            unset($Success);
            $Success = strtolower("success");
        } else {
            unset($Success);
           $MsgError = 'มีข้อมูลที่คุณยังไม่กรอก...........';
        }

        if(isset($Success) && $Success == 'success'){
            $updatedb_member = [

                'id_code'   => $_POST["id_code"],
                'name'      => $_POST["name"],
                'last_name' => $_POST["last_name"],
                'e_mail'    => $_POST["e_mail"],
                'pass'     => $_POST["pass"],
                'phone'      => $_POST["phone"],

            ];
            // $member_updateSQL = "UPDATE members SET name='Alfred Schmidt', last_name='Frankfurt' , e_mail =':e_mail', pass='somphol2543',phone='971271931' WHERE id_code= :id_code";
            // $member_updateSQL = "UPDATE members SET name=:name, last_name=:last_name , e_mail =:e_mail, pass=:pass ,phone=:phone WHERE id_code=:id_code ";
            $member_update = $connectDB->prepare($member_updateSQL);
            if($member_update->execute($updatedb_member)){

                // $_SESSION['e_mail'] = $_POST["e_mail"] ;
                // $_SESSION['name'] = $_POST["name"] ;
                // $_SESSION['last_name'] = $_POST["last_name"] ;
                // $_SESSION['pass'] = $_POST["pass"] ;
                // $_SESSION["phone"] = $_POST["phone"];

                header("location: "._MEMBER."profile.php");
            }
            // $row = $member_update->fetch(PDO::FETCH_ASSOC);
            $connectDB=null;
        }else{
            $MsgError = "No Update To Database";
        }

    
    }
    
// อีเวน
    if(false){

    }

// อีเวน
    if(false){
            
    }






    // Turn off the internet connection.
    if(isset($closeDB) && $closeDB == "Cancel"){
        //echo "ปิดเรียบร้อย";
        $connectDB = null;
    }
    
    //Check Error 
    if(isset($MsgError))
    {
        $_SESSION['success'] = 'ข้อผิดพลาด : '.$MsgError;
        header("location: ../View/Main_Login/");
    }
