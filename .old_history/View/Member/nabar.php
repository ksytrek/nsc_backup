<?php
session_start();
require_once("../../Config/path.php");
include_once('./nabar.php');
require_once('../../Model/ConnectDB.php');
// if ($_SESSION['success_Login'] != 'Member_Login') {
//     header("location: ../../Controller/check_login.php");
// }


// require_once("../../Model/ConnectDB.php");
$i_code = $_SESSION['id_code'];
$check = $connectDB->prepare("SELECT `name`,`last_name`,`e_mail`,`stu_face` FROM `members` WHERE `id_code`='$i_code'");
$check->execute();
$row = $check->fetch(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="stylesheet" href="https://unpkg.com/bootstrap@4.1.0/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Krub:ital@1&family=Roboto:wght@100&display=swap" rel="stylesheet">

    <style type="text/css">
        body {
            /* font-family: 'Krub', sans-serif;
            font-family: 'Roboto', sans-serif; */
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Helvetica Neue, Helvetica, sans-serif;
            font-size: 16px;
            /* margin-left: 15px;
            margin-right: 15px; */
        }
        .showpage{
            margin-left: 10px;
            margin-right:10px;
        }

        .cus-icon:before {
            width: 30px;
            height: 30px;
        }

        /*sidemenu ด้านซ้าย*/
        .l-sidenav {
            position: fixed;
            z-index: 1040;
            top: 0;
            left: 0;
            height: 100%;
            width: 0;
            overflow-x: hidden;
        }
    </style>

</head>

<body>
    <!-- sidemenu ด้านซ้าย-->
    <nav class="l-sidenav bg-light">
        <div class="card bg-primary">
            <div class="navbar navbar-light">
                <a class="invisible"></a>
                <button type="button" class="close  close-l-sidenav  bi-backspace-fill">
                    <span aria-hidden="true">&times;</span>
                </button>


            </div>
            <div class="card-body pt-1 text-center">
                <!-- <img src="<?php echo _WEBSITE.$row['profile_member'] ?>" class="rounded-circle" style="width:70px;height:90px;"> -->
                <h6 class="card-title"><?php echo $row['name']." ".$row['last_name'] ;?></h6>
                <p class="card-text">
                    <?php echo $row['e_mail']?>
                </p>
            </div>
        </div>
        <!-- เมนูแบบที่ 1 -->
        <!-- <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
        </ul> -->

        <!-- เมนูแบบที่ 2 -->
        <ul class="list-group list-group-flush">
            <li  class="list-group-item"><a style="margin-left:0px;" class="link link-secondary  " href="./">หน้าหลัก</a></li>
            <li class="list-group-item">
                <div class="dropdown">
                    <label class="link link-secondary dropdown-toggle" type="text" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ข้อมูลส่วนตัว
                    </label>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <a class="dropdown-item" href="<?php echo _MEMBER.'profile.php'?>"  type="button">ข้อมูลส่วนตัว</a>
                        <a class="dropdown-item" href="<?php echo _MEMBER.'request_room.php'?>"  type="button">ร้องขอใช้ห้อง</a>
                        <?php if($row['stu_face'] == '1'):?>
                            <a class="dropdown-item" href="<?php echo _MEMBER.'face_member.php'?>" type="button">ข้อมูลใบหน้า</a>
                        <?php endif ?>
                        <a class="dropdown-item" href="<?php echo _MEMBER.'history_room.php'?>"  type="button">ประวัติการเข้าห้อง</a>
                    </div>
                </div>
            </li>
            <?php if($row['stu_face'] == '0'):?>
                <li class="list-group-item">
                    <div class="dropdown">
                        <label class="link link-secondary dropdown-toggle" type="text" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            บันทึกใบหน้า
                        </label>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <a class="dropdown-item" href="<?php echo _FACESAVE ?>" type="button">บันทักใบหน้าอัตโนมัติ</a>
                            <a class="dropdown-item" type="button">เมนูที่ 2</a>
                            <a class="dropdown-item" type="button">เมนูที่ 3</a>
                        </div>
                    </div>
                </li>
            <?php endif ?>
            <!-- <li class="list-group-item">ตัวเลือก 3</li> -->
            <!-- <li class="list-group-item">
                รายการเเจ้งเตือน 2
                
                <span class="badge badge-primary badge-pill">45</span>
            </li> -->
            
        </ul>

        <!-- เมนูแบบที่ 3 -->
        <!-- <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                รายการเเจ้งเตือน 2
                
                <span class="badge badge-primary badge-pill">45</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="dropdown">
                    <label class="link link-secondary dropdown-toggle" type="text" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        เมนูอื่น ๆ
                    </label>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <a class="dropdown-item" type="button">เมนูที่ 1</a>
                        <a class="dropdown-item" type="button">เมนูที่ 2</a>
                        <a class="dropdown-item" type="button">เมนูที่ 3</a>
                    </div>
                </div>
            </li>
        </ul> -->
    </nav>

    <!-- ส่วนของการใช้งาน navbar-->
    <nav class="navbar navbar-light bg-primary fixed-top">
        <!-- ปุมด้านซ้าย แสดงเมนู-->
        <button class="navbar-toggler border-0 px-0 open-l-sidenav" type="button">
            <i class="fas fa-bars cus-icon fa-fw py-1"></i>
        </button>
        

        <!--  ส่วนแสดงชื่อโปรเจ็ค หรือหัวข้อที่ต้องการ อยุ่ตรงกลางจอ-->
            <a class="navbar-brand" href="./">ยินดีตอนรับเข้าสู่ระบบ</a>

        <!-- ปุมด้านขวา แสดงเมนู  -->
        <div class="btn-group">
        <button class="navbar-toggler border-0 px-2" onclick="history.back(1);">ยอนกลับ</button>
            <button type="button" class="navbar-toggler border-0 px-2" onclick="On_click()" >
                <!-- <i class="fas fa- cus-icon py-1"></i> -->
                ออกจากระบบ
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                    <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                </svg>
            </button>
        </div>

    </nav>

    <br>
    <br>
    <br>


    <!-- เริ่มหน้า เพจ -->

    <!-- สิ้นสุดหน้า เพจ -->
    <!-- เปิด ส่งท้าย -->
<center>
    <div class="closepage fixed-bottom bottom-auto bg-primary">
        <p  style="margin: 5px;">	&copy; สงวนสิทธิ์ 2021</p>
    </div>
</center>
    <!-- ปิด ส่งท้าย -->



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <!-- <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
    <script src="https://unpkg.com/bootstrap@4.1.0/dist/js/bootstrap.min.js"></script> -->
    <script type="text/javascript">
        $(function() {
            /*เมื่อปุ่มปิด หรือ เปิด เมนูด้านซ้ายถูกคลิก*/
            $(".close-l-sidenav,.open-l-sidenav").on("click", function() {
                var toggleWidth = ($(".l-sidenav").width() == 0) ? 250 : 0;
                $(".l-sidenav").width(toggleWidth);
            });
        });

        function On_click() {
            confirm('ยืนยันการออกจากระบบ!!');
            location.href="../../Controller/logout_click.php";
        }
    </script>
</body>

</html>