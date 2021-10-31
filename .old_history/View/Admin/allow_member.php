<?php 
    include("./nabar.php");
    // require_once("../../Config/path.php");
    if(empty($_GET['id'])):
?>
<script>
        window.location.href='<?php echo _ADMIN ?>';
</script>
<?php 
    endif;
    $search = [
        'rq_id'  => $_GET['id']
    ];
    $allowrq = $connectDB->prepare("SELECT * FROM `rqroom` INNER JOIN rooms ON rqroom.room_code = rooms.room_code INNER JOIN members ON rqroom.std_code = members.id_code WHERE  rqroom.rq_id=:rq_id");
    // $searchdb = $connectDB->prepare("SELECT * FROM `tbimage` WHERE `std_code`=:id_code");
    $allowrq->execute($search);
    $row = $allowrq->fetch(PDO::FETCH_ASSOC)
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allow Member</title>

    <script src="../../Script/jquery/jquery-3.5.1.js"></script>

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

    <h3>Profile : <?php echo $row["name"]."  ". $row["last_name"] ?></h3>
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
            <div id="id_code" class="col-sm-6">รหัสนักศึกษา : <?php echo $row["id_code"] ?>  </div>
            <div class="col-sm-6">Name : <?php echo $row["name"].'  '. $row["last_name"] ?></div>
            <div class="col-sm-6">E-Mail :<?php echo $row["e_mail"] ?></div>
            <div class="col-sm-6">Phone : <?php echo $row["phone"] ?></div>
            <div class="col-sm-6">สถานะ : <?php echo $row["position"] ?></div>
            <div class="col-sm-6">
                <button style="background-color:greenyellow" name="allow" onclick="Allow(<?php echo $_GET['id'] ?>,<?php echo $row['id_code'] ;?>,<?php echo '1' ;?>)" > อนุญาติ</button>
                <button style="background-color:red; color:honeydew" name="notallow" onclick="Not_Allow(<?php echo $_GET['id'] ?>,<?php echo $row['id_code'] ?>,<?php echo '2' ;?>)">ไม่อนุญาติ</button>
            </div>
        </div>
    </div>
    
</body>


<script>
    function Allow(id,code,status) {
        var str = [];
        confirm('คุณต้องการอนุญาติ!!!!');

        $.ajax({
            type: "POST",
            url: "<?php echo _CRL_ADMIN."rqroom_allow.php" ?>",
            data: {
                id: id,
                id_Code:code,
                status:status
                // แก้ให้รับค่า จาก php ได้
            },
            success: function(response) {
                
                console.log('Allow : ' + response); 
                // location.reload();
                location.href='<?php echo _ADMIN ?>';
            }
        });
    }
    function Not_Allow(id,code,status) {
        confirm('คุณต้องการไม่อนุญาติ!!!!');
        var idrq = document.getElementById('id_code');
        $.ajax({
            type: "POST",
            url: "<?php echo _CRL_ADMIN."rqroom_allow.php" ?>",
            data: {
                id: id,
                id_Code: code,
                status:status
                 // แก้ให้รับค่า จาก php ได้

            },
            // success: function(response) {
            //     console.log('Not_Allow: ' + response); 
            //     location.reload();
            //     location.href='<?php echo _ADMIN ?>';
            // }
        }).done(function(response){
            console.log('saved: ' + response); 
            location.href='<?php echo _ADMIN ?>';
        });
    }
</script>
</html>