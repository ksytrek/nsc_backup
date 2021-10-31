<?php
// session_start();
require_once('../../Config/path.php');
require_once('../../Model/ConnectDB.php');
include_once('./nabar.php');

if ($_SESSION['success_Login'] != 'Member_Login') {
    header("location: ../../Controller/check_login.php");
}

if(!empty($_GET["id"])){

$search = [
    'id_code'  => $_SESSION['id_code']
];


// 2 Table members AND tbimage
// SELECT * FROM members INNER JOIN tbimage ON members.id_code = tbimage.std_code WHERE members.id_code = '62122710108';
// $searchdb = $connectDB->prepare("SELECT * FROM `tbimage` WHERE `std_code`=:id_code");
// $searchdb = $connectDB->prepare("SELECT id_code, name , last_name , e_mail , pass , position , area_code , phone , path_image , name_image FROM members INNER JOIN tbimage ON members.id_code = tbimage.std_code WHERE members.id_code = '62122710108'");
// $searchdb->execute($search);



$search = [
    'id_code'  => $_GET['id']
];

$searchimg = $connectDB->prepare("SELECT * FROM `tbimage` WHERE `std_code`=:id_code");
$searchdb = $connectDB->prepare("SELECT * FROM members  WHERE members.id_code =:id_code");

$searchdb->execute($search);
$row = $searchdb->fetch(PDO::FETCH_ASSOC);

$searchimg->execute($search);
$rowimg = $searchimg->fetch(PDO::FETCH_ASSOC);


$position = "";
if ($row['position'] == 'student'):
    $position = 'นักศึกษา';
elseif ($row['position'] == 'professor') :
    $position = 'อาจารย์';
elseif ($row['position'] == 'other'):
    $position = 'บุคคลอื่น';

endif;

?>
<html>

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Profile Edit</title>
    <!-- Main jquery-->
    <!-- <script src="../../Script/jquery/jquery-3.5.1.js"></script> -->
    <!-- Main CSS-->
    <!-- <link href="../../Script/css/bootstrap.min.css" rel="stylesheet" media="all"> -->
</head>

<body>
    <br>
    <br>
    <br> 
    
    <h3>Edit Profile : <?php echo $_SESSION['Member_Login'] ?></h3>
    <hr>
    <h4><p>แก้ไขข้อมูลส่วนตัว</p></h4>

<br>

    <form action="<?php echo _CONTROLLER.'Controller_Click.php' ?>" method="POST">
        <div class="row g-0">
            <div class="col-6 col-md-4">
                <img src="<?php echo _WEBSITE."//".$rowimg['path_image'].$rowimg['name_image'] ?>" width="350px" height="350px" class="img-thumbnail" alt="Image Profile"> 
            </div>
            <div class="col-sm-6 col-md-8">
                <div class="col-sm-6">รหัสนักศึกษา : <?php echo $row['id_code'] ?><input type="text" hidden  name="id_code" value="<?php echo $row['id_code'] ?>">   </div>
                <div class="col-sm-6">Name : <input type="text" name="name" value="<?php echo $row['name'] ?>" required ></div>
                <div class="col-sm-6">Last Name : <input type="text" name="last_name" value="<?php echo $row['last_name'] ?>" required> </div>
                <div class="col-sm-6">E-Mail : <input type="email" name="e_mail" value="<?php echo $row['e_mail'] ?>" required> </div>
                <div class="col-sm-6">Password : <input type="password" name="pass" value="<?php echo $row['pass'] ?>" required> </div>
                <div class="col-sm-6">Phone : <input type="text" name="phone" value="<?php echo $row['phone'] ?>" required> </div>
                <div class="col-sm-6">สถานะ : <?php echo $position ?> <input type="text" name="position" hidden value="<?php echo $row['position'] ?>">  </div>
                <div>
                    <button type="submit" name="edit_submit" onclick="return confirm('คุณต้องการแก้ไขข้อมูล!!!!')" >เเก้ไข</button>
                </div>
        

            </div>
        </div>  
    </form>
    
    <!-- <script src="../../Script/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> -->
    <?php 
        //   echo ( ($row['position'] == 'student3' ? 'นักศึกษา'  : ($row['position'] == 'student3' ? 'นักศึกษา')));
        
    }else{header("location: "._CONTROLLER.'check_login.php');} ?>
</body>

</html>