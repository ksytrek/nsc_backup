<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar.php")
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
                            <?php if(true): ?>
                            <div class="card-title float-right">
                                <button type="button" class="btn  btn-warning btn-rounded " onclick="save_face()">ยังไม่ได้บันทึกภาพใบหน้า</button>
                            </div>
                            <script>
                                function save_face(){
                                    if(confirm("คุณสามารถบันทึกได้เพียงครั้งเดี่ยว")){
                                        location.assign("./on_save_face.php");
                                    }else{
                                        // alert("cancel");
                                    }
                                }
                            </script>
                            <?php endif;?>
                            <?php if(false):?>
                                <div class="card-title float-right">
                                    <button type="button" class="btn  btn-danger btn-rounded " onclick="window.confirm('ลบข้อมูลรูปภาพอย่างถาวร จะไม่สารถกู้คืนได้ !!!')">ลบข้อมูลรูปภาพ</button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row ">
                        <?php if(false):?>
                        <div class="col-lg-3">
                            <img src="../../script/assets/images/3.jpg" width="100%" alt="">
                        </div>
                        <div class="col-lg-3">
                            <img src="../../script/assets/images/3.jpg" width="100%" alt="">
                        </div>
                        <div class="col-lg-3">
                            <img src="../../script/assets/images/3.jpg" width="100%" alt="">
                        </div>
                        <div class="col-lg-3">
                            <img src="../../script/assets/images/3.jpg" width="100%" alt="">
                        </div>
                        <div class="col-lg-3">
                            <img src="../../script/assets/images/3.jpg" width="100%" alt="">
                        </div>
                        <div class="col-lg-3">
                            <img src="../../script/assets/images/3.jpg" width="100%" alt="">
                        </div>
                        <div class="col-lg-3">
                            <img src="../../script/assets/images/3.jpg" width="100%" alt="">
                        </div>
                        <div class="col-lg-3">
                            <img src="../../script/assets/images/3.jpg" width="100%" alt="">
                        </div>
                        <div class="col-lg-3">
                            <img src="../../script/assets/images/3.jpg" width="100%" alt="">
                        </div>
                        <div class="col-lg-3">
                            <img src="../../script/assets/images/3.jpg" width="100%" alt="">
                        </div>
                        <div class="col-lg-3">
                            <img src="../../script/assets/images/3.jpg" width="100%" alt="">
                        </div>
                        <div class="col-lg-3">
                            <img src="../../script/assets/images/3.jpg" width="100%" alt="">
                        </div>
                        <div class="col-lg-3">
                            <img src="../../script/assets/images/3.jpg" width="100%" alt="">
                        </div>
                        <div class="col-lg-3">
                            <img src="../../script/assets/images/3.jpg" width="100%" alt="">
                        </div>
                        <div class="col-lg-3">
                            <img src="../../script/assets/images/3.jpg" width="100%" alt="">
                        </div>
                        <div class="col-lg-3">
                            <img src="../../script/assets/images/3.jpg" width="100%" alt="">
                        </div>
                        <?php endif;?>
                    </div>

            </div>
            <!-- /# row -->



        </div>
    </div>
    </div>


</body>

</html>