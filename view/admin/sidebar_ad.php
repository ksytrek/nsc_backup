<!DOCTYPE html>
<html lang="en">
<?php
    date_default_timezone_set('Asia/Bangkok');

    session_start();
    include("../../config/connectdb.php");
    $id_admin = $_SESSION['id_admin'];


    if(isset($_SESSION["key_login"]) && $_SESSION["key_login"] == "admin"){
        $id_admin = $_SESSION['id_admin'];
    }else{
        header("Location:"."../controller/check_logout.php");
    }
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../../script/assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../../script/assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../../script/assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="../../script/assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="../../script/assets/css/lib/weather-icons.css" rel="stylesheet" />
    <link href="../../script/assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="../../script/assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../../script/assets/css/lib/helper.css" rel="stylesheet">
    <link href="../../script/assets/css/style.css" rel="stylesheet">

    <link href="../../script/assets/css/lib/sweetalert/sweetalert.css" rel="stylesheet">
    <!-- <link href="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->


    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

</head>

<body>

    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <div class="logo"><a href="./dashboard_ad.php">
                            <img src="../../script/assets/images/logo.png" width="50px" height="50px" alt="" /><span>KSY Trek</span>
                        </a></div>
                    <li class="label">หน้าหลัก</li>
                    <li><a href="./dashboard_ad.php"><i class="ti-home"></i> Dashboard </a> </li>

                    <li class="label">Management</li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-id-badge"></i>Personal Management<span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="./mg_personal_ad.php">จัดการตารางบุคลากร</a></li>
                            
                            <li><a href="./on_face_name.php">บันทึกภาพใบหน้า</a></li>
                        </ul>
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-layout-column2"></i>Rooms Management<span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="./mg_room_ad.php">จัดการตารางห้อง</a></li>
                            <!-- <li><a href="./check_request_ad.php">ตรวจสอบการร้องขอ</a></li> -->
                            <li><a href="./room_history_all.php">ประวัติการ เข้า ห้อง</a></li>
                            
                        </ul>
                    </li>
                    <li><a href="./mg_permissions.php"><i class="ti-filter"></i> จัดการสิทธิ์ใช้ห้อง </a></li>
                    <li class="label">Back up</li>
                    <li><a href="./backup_data_personal.php"><i class="ti-check-box"></i> สำรองข้อมูลบุคลากร </a></li>
                    <!-- <li><a href="./backup_data_imageface.php"><i class="ti-gallery"></i> สำรองข้อมูลรูปภาพใบหน้า </a></li> -->
                    <li><a href="./backup_data_room.php"><i class="ti-folder"></i> สำรองข้อมูลห้อง </a></li>

                    <li class="label">อื่น ๆ</li>
                    <!-- <li><a href="./report.php"><i class="ti-bar-chart-alt"></i>สรุปรายงาน </a></li> -->
                    <li><a href="./train_model.php"><i class="ti-headphone-alt"></i>ฝึกโมเดล</a></li>
                    <li><a href="./mg_admin.php"><i class="ti-key"></i>ผู้ดูแลระบบ</a></li>
                    <li><a href="../controller/check_logout.php"><i class="ti-close"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /# sidebar -->
    <div class="header">
        <div class="container-fluid  ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </div>
                    <div class="float-right">
                        <div class="dropdown dib">
                            <ul>
                                <li class=" header-icon  dropdown">
                                    <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                        <i class=" ti-settings "></i>
                                    </div>
                                    <div class="drop-down   dropdown-menu">
                                        <div class="dropdown-content-body">
                                            <ul>
                                                <li>
                                                    <a href="./personal_search_ad.php"><i class="ti-user"></i> <span>
                                                            Profile</span></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="ti-lock"></i> <span> Lock Screen</span></a>
                                                </li>
                                                <li><a href="../controller/check_logout.php"><i class="ti-close"></i> <span>
                                                            Logout</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <span class="user-avatar">

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    <!-- Common -->
    <script src="../../script/assets/js/lib/jquery.min.js"></script>
    <script src="../../script/assets/js/lib/jquery.nanoscroller.min.js"></script>
    <script src="../../script/assets/js/lib/menubar/sidebar.js"></script>
    <script src="../../script/assets/js/lib/preloader/pace.min.js"></script>
    <script src="../../script/assets/js/lib/bootstrap.min.js"></script>
    <script src="../../script/assets/js/scripts.js"></script>

    <script src="../../script/assets/js/sweetalert.min.js"></script>


    <script src="../../script/assets/js/lib/weather/jquery.simpleWeather.min.js"></script>
    <script src="../../script/assets/js/lib/weather/weather-init.js"></script>
    <script src="../../script/assets/js/lib/circle-progress/circle-progress.min.js"></script>
    <script src="../../script/assets/js/lib/circle-progress/circle-progress-init.js"></script>
    <!-- <script src="../../script/assets/js/lib/chartist/chartist.min.js"></script> -->
    <script src="../../script/assets/js/lib/sparklinechart/jquery.sparkline.min.js"></script>
    <script src="../../script/assets/js/lib/sparklinechart/sparkline.init.js"></script>
    <script src="../../script/assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="../../script/assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
    <script src="../../script/vfs_fonts.js"></script>


    <!-- scripit init-->
    <!-- <script src="../../script/assets/js/dashboard2.js"></script> -->

<!-- 
    <script src="../../script/assets/js/lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.js"></script> -->
</body>

</html>