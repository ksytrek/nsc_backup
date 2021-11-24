<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar.php");

$row_members = Database::query("SELECT * FROM members WHERE `id_mem`= {$id_mem};", PDO::FETCH_ASSOC)->fetch();


?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Face Admin Dashboard</title>


</head>

<body>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <!-- <h1>Hello, <span>Welcome Here</span></h1> -->
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Personal Information</a></li>
                                    <li class="breadcrumb-item active">ตรวจสอบภาพ</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">

                    <div class="row">
                        <div class="col-lg-6">

                            <div class="card-title">
                                <h4>แสดงรูปภาพใบหน้าของคุณ </h4>
                            </div>

                        </div>
                        <div class="col-lg-6 ">
                            <div class="user-send-message">
                                <?php if ($row_members['stu_face'] == '0') : ?>
                                    <div class="card-title float-right">
                                        <button type="button" class="btn  btn-warning btn-rounded btn-sm" onclick="save_face()">ยังไม่ได้บันทึกภาพใบหน้า</button>
                                    </div>
                                    <script>
                                        function save_face() {
                                            if (confirm("คุณสามารถบันทึกได้เพียงครั้งเดี่ยว")) {
                                                location.assign("./on_save_face.php");
                                            } else {
                                                // alert("cancel");
                                            }
                                        }
                                    </script>
                                <?php 
                                endif; 
                                if ($row_members['stu_face'] == '1') : 
                                ?>
                                    <!-- <div class="card-title float-right">
                                        <button type="button" class="btn  btn-danger btn-rounded btn-sm" onclick="window.confirm('ลบข้อมูลรูปภาพอย่างถาวร จะไม่สารถกู้คืนได้ !!!')">ลบข้อมูลรูปภาพ</button>
                                    </div> -->
                                    <div class="card-title float-right">
                                        <form method="post" action="./controller/backup.php">
                                            <input type="hidden" name="id_mem" value="<?php echo $id_mem; ?>">
                                            <button id="backup" name="backup" class="btn btn-info btn-rounded btn-sm" type="submit">
                                                <i class="ti-cloud-down"></i>&nbsp;&nbsp;สำรองข้อมูล</button>
                                        </form>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                        <style>
                            /* input[type=checkbox] {

                                -ms-transform: scale(1.5);
                                -moz-transform: scale(1.5);
                                -webkit-transform: scale(1.5);
                                -o-transform: scale(1.5);
                                transform: scale(1.5);
                                padding: 10px;
                                margin-left: 10px;
                                margin-top: 20px;
                            } */


                            label {
                                font-size: 105%;
                            }

                            .img_face {
                                border-radius: 10px;
                                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.5);
                            }
                        </style>
                        <div class="row ">
                            <?php
                            if ($row_members['stu_face'] == '1') :
                                foreach (Database::query("SELECT * FROM `tbimage` INNER JOIN `members` ON tbimage.id_mem = members.id_mem WHERE tbimage.id_mem = {$id_mem};", PDO::FETCH_ASSOC) as $row) :                            ?>
                                    <div class="col-lg-3">
                                        <img class='img_face' src="../../<?php echo $row['path_image'] . $row['name_image'] ?>" width="100%" alt="">
                                    </div>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </div>

                    </div>
            </div>
        </div>
    </div>


</body>

</html>