<?php 
    require_once('../Config/path.php');
?>

<?php
session_start();
if(!empty($_SESSION['success_Login'])){
    header("location: "._CONTROLLER.'check_login.php');
}else{
    header("location: "._WEBSITE);
}
?>

<!-- เผื่อมีการพัฒนาต่อ -->
    <!-- Page Memer -->
    <!-- <?php if($Login == "Member_Login"): require_once("Member/index.php");?>
        
        <a href="../Controller/logout.php">Logout</a>
    <?php endif?> -->

    <!-- Page Admin -->
    <!-- <?php if($Login == "Admin_Login"):?>

       <p>Admin</p>
       <a href="../Controller/logout.php">Logout</a>
    <?php endif?> -->




