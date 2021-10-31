<?php
// session_start();
include_once('./nabar.php');


$search = [
    'id_code'  => $_SESSION['id_code']
];
$searcchsche = $connectDB->prepare("SELECT * FROM `schedule`");
// $searchdb = $connectDB->prepare("SELECT * FROM `tbimage` WHERE `std_code`=:id_code");
$searcchsche->execute();


$searchrq = $connectDB->prepare("SELECT * FROM `rqroom` INNER JOIN rooms ON rqroom.room_code = rooms.room_code INNER JOIN members ON rqroom.std_code = members.id_code");
// $searchdb = $connectDB->prepare("SELECT * FROM `tbimage` WHERE `std_code`=:id_code");
$searchrq->execute();

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
    <title>Admin HOME</title>
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
            margin-left: 3rem;
            margin-right: 3rem;
        }

    </style>
</head>

<body>
    
    <h3>Welcome TO : <?php echo $_SESSION['e_mail_ad'] ?></h3>
    <hr>
    <!-- เเจ้งเตือนเมื่อมีการทำกิจกรรมบางอย่างเสร็จ -->
    <?php
        if(isset($_SESSION['success']) && $_SESSION['success'] ==  "success"): ?>
            <div class="alert alert-primary" role="alert">
                <?php echo "ส่งคำขอใช้งานห้องสำเร็จและรอการยืนยัน";?>
            </div>
    <?php
       unset($_SESSION['success']);
        endif;     
    ?> 
    <h4><u>รายชื่อสมาชิกที่ต้องการร้องขอใช้ห้อง</u></h4>
    <div style="display:block; width:850px">
        <table class="table">
            <thead>
                <tr align="center">
                    <th style="width:50px" scope="col">ลำดับ</th>
                    <th scope="col">รหัส</th>
                    <th scope="col">ชื่อ</th>
                    <th scope="col">เลขห้อง</th>
                    <th scope="col">จัดการ</th>
                </tr>
            </thead>
            <tbody align="center">
                <?php 
                    $i = 1;
                    while($row = $searchrq->fetch(PDO::FETCH_ASSOC)):
                ?>
                    <tr>
                        <th scope="row"><?php echo $i ;?></th>
                        <td><?php echo $row['std_code']?></td>
                        <td><?php echo $row['name']."  ".$row['last_name'] ?></td>
                        <td><?php echo $row['room_num']?></td>
                        <td><a href="./allow_member.php?id=<?php echo $row['rq_id'] ?>"> <?php echo $row['room_num']?> </a></td>
                    </tr>
                <?php $i++; endwhile;?>
            </tbody>
        </table>
    </div>

    <h4><u>ประวัติการใช้ห้อง</u></h4>
    <div style="display:block; width:850px">
        <table class="table">
            <thead>
                <tr align="center">
                    <th scope="col">ลำดับ</th>
                    <th scope="col">รหัสตัวต้น</th>
                    <th scope="col">หมายเลขห้อง</th>
                    <th scope="col">วันเวลา</th>
                </tr>
            </thead>
            <tbody align="center">
                <?php 
                    $i = 1;
                    while($row = $searcchsche->fetch(PDO::FETCH_ASSOC)):
                ?>
                <tr>
                    <th scope="row"><?php echo $i ;?></th>
                    <td><?php echo $row['std_code']?></td>
                    <td><?php echo $row['room_code']?></td>
                    <td><?php echo $row['time_stamp']?></td>
                </tr>
                <?php $i++; endwhile;?>
            </tbody>
        </table>
    </div>

    

<br>


    <!-- <script src="../../Script/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> -->
</body>

</html>