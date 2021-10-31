<?php
// session_start();
require_once('../../Config/path.php');
require_once('../../Model/ConnectDB.php');
include_once('./nabar.php');

if ($_SESSION['success_Login'] != 'Member_Login') {
    header("location: ../../Controller/check_login.php");
}


$search = [
    'id_code'  => $_SESSION['id_code']
];

$searchimg = $connectDB->prepare("SELECT * FROM `tbimage` WHERE `std_code`=:id_code");
$searchdb = $connectDB->prepare("SELECT * FROM members  WHERE members.id_code =:id_code");

$searchdb->execute($search);
$row = $searchdb->fetch(PDO::FETCH_ASSOC);
$searchimg->execute($search);
$rowimg = $searchimg->fetch(PDO::FETCH_ASSOC);


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
    <title>Profile</title>
    <!-- Main jquery-->
    <script src="../../Script/jquery/jquery-3.5.1.js"></script>
    <!-- Main CSS-->
</head>

<body>

    <h3>Profile : <?php echo $_SESSION['Member_Login'] ?></h3>
    <hr>
    
    <h2></h2>
    <h4><p>ข้อมูลส่วนตัว</p></h4>
    <div>
        <div>
        </div>
        <div>
            
        </div>
    </div>
<br>
    <div class="row g-0">
        <div class="col-6 col-md-4">
            <img  src="<?php echo _WEBSITE.$row['profile_member'] ?>" width="250px" height="150px" class="img-thumbnail" alt="Image Profile" style="border: 0; margin-left: 70px;"> 
        </div>
        <div class="col-sm-6 col-md-8">
            <div class="col-sm-6">รหัสนักศึกษา : <?php echo $row["id_code"] ?>  </div>
            <div class="col-sm-6">Name : <?php echo $row["name"].'  '. $row["last_name"] ?></div>
            <div class="col-sm-6">E-Mail :<?php echo $row["e_mail"] ?></div>
            <div class="col-sm-6">Phone : <?php echo $row["phone"] ?></div>
            <div class="col-sm-6">สถานะ : <?php echo $row["position"] ?></div>
            <div class="col-sm-6"><button name="edit_id"><a href="./profile_edit.php?id=<?php echo $row['id_code'] ?>" onclick="return confirm('คุณต้องการแก้ไขข้อมูล!!!!')" >อัพเดตข้อมูล</a></button></div>
        </div>
    </div>  
    

</body>

</html>