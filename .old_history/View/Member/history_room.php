<?php
include('./nabar.php');
require_once('../../Config/path.php');
require_once('../../Model/ConnectDB.php');
// session_start();

$dbsch = [
    'std_code'  => $_SESSION["id_code"]
];
//SELECT schedule.std_code , rooms.room_num , schedule.time_stamp FROM schedule INNER JOIN rooms ON schedule.room_code = rooms.room_code  WHERE schedule.std_code = :std_code AND time_stamp BETWEEN '2020-01-01' AND '2021-12-31' ORDER BY schedule.time_stamp DESC
$schedule = $connectDB->prepare("SELECT schedule.std_code , rooms.room_num , schedule.time_stamp FROM schedule INNER JOIN rooms ON schedule.room_code = rooms.room_code  WHERE schedule.std_code = :std_code  ORDER BY schedule.time_stamp DESC");
$schedule->execute($dbsch);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery-3.5.1.js"></script>
    <title>ค้นหา a room</title>

</head>

<body>
    <h3>ประวิติการเข้าห้อง : <?php echo $_SESSION["Member_Login"] ?></h3>
    <hr>
<?php if(false):?>
    <div style="display:block; width:100% ;" align="center">
        <h4>ระบุช่วงวันที </h4>
        <div  style="display:block; width:80% ;">

            <form method="POST" name="frmMain">
                <div class="input-group mb-3">
                    <input id="txtSearch" type="date" value="2020-01-01" name="txtSearch" class="form-control" placeholder="กรุณากรอกชื่อห้องที่ต้องการร้องขอ" aria-label="Recipient's username" aria-describedby="button-addon2">   
                    <div class="badge badge-primary text-wrap" style="width: 3rem; margin:7px">
                        ถึงวันที่
                    </div>
                    <input id="txtSearch1" type="date" value="<?php echo date('Y-m-d') ?>" name="txtSearch1" class="form-control" placeholder="กรุณากรอกชื่อห้องที่ต้องการร้องขอ" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" name="btnSearch" id="btnSearch">ค้นหาห้อง</button>
                </div>
            </form>
        </div>
    </div>
<?php endif;?>
<?php if(true): ?>
    <div style="display:block; width:100% ;" align="center">
        <div  style="display:block; width:50% ;">

            <table class="table">
                <thead>
                    <tr align="center">
                        <th scope="col">ลำดับ</th>
                        <th scope="col">วันที่</th>
                        <th scope="col">ชื่อห้อง</th>
                        <th scope="col">รหัสนักศึกษา</th>
                    </tr>
                </thead>
                <?php
                    
                    $i = 1;
                    while ($objResult = $schedule->fetch(PDO::FETCH_ASSOC)){
                        ?>
                            <tbody>
                                <tr align="center">
                                    <th scope="row"><?php echo $i ?></th>
                                    <td><?php echo $objResult["time_stamp"]; ?></td>
                                    <td><?php echo $objResult["room_num"]; ?></td>
                                    <td><?php echo $objResult["std_code"]; ?></td>
                                </tr>
                            </tbody>
                        <?php
                    $i++;
                    }
                    
                ?>
            </table>

        </div>
    </div>
<?php endif; ?>
</div>


<br>

<!-- <button type="button" onclick="history.back(1)">ยอนกลับ</button> -->
</body>

</html>