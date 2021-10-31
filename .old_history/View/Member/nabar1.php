<?php
session_start();
include_once('./nabar.php');
require_once('../../Model/ConnectDB.php');
if ($_SESSION['success_Login'] != 'Member_Login') {
    header("location: ../../Controller/check_login.php");
}


// require_once("../../Model/ConnectDB.php");
$i_code = $_SESSION['id_code'];
$check = $connectDB->prepare("SELECT `stu_face` FROM `members` WHERE `id_code`='$i_code'");
$check->execute();
$row = $check->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../Script/css/bootstrap.min.css" rel="stylesheet" media="all">

 <!-- <link href=" ../../Script/link_script.php" rel="stylesheet" media="all"> -->
 <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary fixed-top ">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">Mamber</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ข้อมูลส่วนตัว
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="profile.php">ข้อมูลส่วนตัว</a></li>
                            <?php if($row['stu_face'] == '1'):?>
                            <li><a class="dropdown-item" href="face_member.php">ใบหน้า</a></li>
                            <?php endif ?>
                            <!-- <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticBackdrop">บันทึกใบหน้า</a></li> -->
                        </ul>
                    </li>
                    <?php if($row['stu_face'] == '0'):?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            บันทึกใบหน้า
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="./faceSave/">บันทึก-แบบอัตโนมัติ</a></li>
                            <li><a class="dropdown-item" href="#">บันทึก-แบบกดถ่าย</a></li>
                            <li><a class="dropdown-item" href="#">บันทึก-แบบอัพโหลดไฟล์</a></li>
                        </ul>
                    </li>
                    <?php endif ?>
                    <li class="nav-item dropdown">
                        <a id="adout" href="request_room.php"  class="nav-link" >
                            ร้องขอใช้ห้อง
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="adout" href="adout.php"  class="nav-link" >
                            Adout
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="logout" class="nav-link" href="../../Controller/logout_click.php" onclick="return confirm('ยืนยันการออกจากระบบ!!')">
                            ออกจากระบบ
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> -->
    <script src="../../Script/js/bootstrap.bundle.min.js"></script>

</body>
</html>