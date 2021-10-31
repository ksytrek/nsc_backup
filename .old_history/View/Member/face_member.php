<?php
// session_start();
include_once('./nabar.php');



$search = [
    'id_code'  => $_SESSION['id_code']
];
$searchdb = $connectDB->prepare("SELECT * FROM members INNER JOIN tbimage ON members.id_code = tbimage.std_code WHERE members.id_code =:id_code");

// $searchdb = $connectDB->prepare("SELECT * FROM `tbimage` WHERE `std_code`=:id_code");
$searchdb->execute($search);

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
    <title>Mamber HOME</title>
    <!-- Main jquery-->
    <script src="../../Script/jquery/jquery-3.5.1.js"></script>
    <!-- Main CSS-->
    <!-- <link href="../../Script/css/bootstrap.min.css" rel="stylesheet" media="all"> -->
</head>

<body>
    <h3>Welcome TO : <?php echo $_SESSION['Member_Login'] ?></h3>
    <hr>
<center>
<?php while ($row = $searchdb->fetch(PDO::FETCH_ASSOC)) :   ?>
        <img src="<?php echo "../../".$row['path_image'].$row['name_image'] ?>" alt="" srcset="">
		
		
	<?php #echo "../../".$row['path_image'].$row['name_image'] ?>
    <?php endwhile ?>

</center>
    
    <!-- <script src="../../Script/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> -->
</body>

</html>