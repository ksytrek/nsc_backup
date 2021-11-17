<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('../../config/connectdb.php');
$id_mem;
if(isset($_SESSION["key_login"]) && $_SESSION["key_login"] == "personal"){
    $id_mem =  $_SESSION["id_mem"];
}else{
    header("Location:"."../controller/check_logout.php");
}

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link href="../../script/assets/css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="../../script/assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../../script/assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../../script/assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="../../script/assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="../../script/assets/css/lib/weather-icons.css" rel="stylesheet" />
    <link href="../../script/assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="../../script/assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../../script/assets/css/lib/helper.css" rel="stylesheet">
    <link href="../../script/assets/css/style.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

</head>

<body>

    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <div class="logo"><a href="./dashboard.php">
                    <img src="../../script/assets/images/logo.png" width="50px" height="50px" alt="" /><span>LOGO</span>
                        </a></div>
                    <li class="label">หน้าหลัก</li>
                    <li><a href="./dashboard.php"><i class="ti-home"></i> Dashboard   </a> </li>

                    <li class="label">Personal Information</li>
                    <li><a href="./personal.php"><i class="ti-user"></i> Profile</a></li>
                    <li><a href="./request_room.php"><i class="ti-announcement"></i> Request to use the room</a></li>
                    <li><a href="./image_search.php" ><i class="ti-flickr-alt"></i>Face image data </a></li>
                    <!-- <li><a href="./on_save_face.php" onclick="window.confirm('เตือนคุณสามารถอัพโหลดได้เพียงครั้งเดี่ยว กรุณาเตรียมตัวให้พร้อมก่อนกด OK !!!!')"><i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                </svg></i> Save the face</a></li> -->

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
                                                <a href="./personal.php"><i class="ti-user"></i> <span> Profile</span></a>
                                            </li>


                                            <!-- <li>
                                                <a href="#"><i class="ti-lock"></i> <span> Lock Screen</span></a>
                                            </li> -->
                                            <li><a href="../controller/check_logout.php"><i class="ti-close"></i> <span> Logout</span></a></li>
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




    <!-- jquery vendor -->
    <script src="../../script/assets/js/lib/jquery.min.js"></script>
    <script src="../../script/assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="../../script/assets/js/lib/menubar/sidebar.js"></script>
    <script src="../../script/assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->

    <script src="../../script/assets/js/lib/bootstrap.min.js"></script>
    <script src="../../script/assets/js/scripts.js"></script>
    <script src="../../script/assets/js/sweetalert.min.js"></script>

    <!-- bootstrap -->


    <!-- scripit init-->
    <!-- <script src="../../script/assets/js/dashboard2.js"></script> -->


</body>

</html>