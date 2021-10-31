<?php
// session_start();
include_once('./nabar.php');


$search = [
    'id_code'  => $_SESSION['id_code']
];
$searchrq = $connectDB->prepare("SELECT rooms.room_num , rqroom.dtime FROM rooms INNER JOIN rqroom ON rooms.room_code = rqroom.room_code WHERE rqroom.std_code =:id_code");
// $searchdb = $connectDB->prepare("SELECT * FROM `tbimage` WHERE `std_code`=:id_code");
$searchrq->execute($search);


$searchel = $connectDB->prepare("SELECT rooms.room_num FROM `eligibility` INNER JOIN rooms ON rooms.room_code = eligibility.room_code WHERE eligibility.std_code =:id_code");
// $searchdb = $connectDB->prepare("SELECT * FROM `tbimage` WHERE `std_code`=:id_code");
$searchel->execute($search);

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
    <style type="text/css">
        body {
            /* font-family: 'Krub', sans-serif;
            font-family: 'Roboto', sans-serif; */
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Helvetica Neue, Helvetica, sans-serif;
            font-size: 16px;
            /* margin-left: 15px;
            margin-right: 15px; */
            margin-left: 0.5rem;
            margin-right: 0.5rem;
        }

    </style>
</head>

<body>
    
    <h3>Welcome TO : <?php echo $_SESSION['Member_Login'] ?></h3>
    <hr>
    <?php
        if(isset($_SESSION['success']) && $_SESSION['success'] ==  "success"): ?>
            <div class="alert alert-primary" role="alert">
                <?php echo "ส่งคำขอใช้งานห้องสำเร็จและรอการยืนยัน";?>
            </div>
    <?php
       unset($_SESSION['success']);
        endif;  
        
        
        
    ?> 
    <h4><u>ห้องที่มีสิทธิ์</u></h4>
    <div style="display:block; width:450px">
        <table class="table">
            <thead>
                <tr align="center">
                    <th scope="col">ลำดับ</th>
                    <th scope="col">ชื่อห้อง</th>
                </tr>
            </thead>
            <tbody align="center">
                <?php 
                    $i = 1;
                    while($row = $searchel->fetch(PDO::FETCH_ASSOC)):
                ?>
                    <tr>
                        <th scope="row"><?php echo $i ;?></th>
                        <td><?php echo $row['room_num']?></td>
                    </tr>
                <?php $i++; endwhile;?>
            </tbody>
        </table>
    </div>

    <h4><u>ตารางคำขอเข้าห้อง</u></h4>
    <div style="display:block; width:450px">
        <table class="table">
            <thead>
                <tr align="center">
                    <th scope="col">ลำดับ</th>
                    <th scope="col">ชื่อห้อง</th>
                    <th scope="col">เวลาร้องขอ</th>
                </tr>
            </thead>
            <tbody align="center">
                <?php 
                    $i = 1;
                    while($row = $searchrq->fetch(PDO::FETCH_ASSOC)):
                ?>
                <tr>
                    <th scope="row"><?php echo $i ;?></th>
                    <td><?php echo $row['room_num']?></td>
                    <td><?php echo $row['dtime']?></td>
                </tr>
                <?php $i++; endwhile;?>
            </tbody>
        </table>
    </div>

    

<br>


    <!-- <script src="../../Script/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> -->
</body>

</html>