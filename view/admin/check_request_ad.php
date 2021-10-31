<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar_ad.php")
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Check Request</title>

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
                                    <li class="breadcrumb-item"><a href="./check_request_ad.php">Management Room</a></li>
                                    <li class="breadcrumb-item active">Check Request</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>ตรวจสอบการร้องขอของบุคลากร</h4>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover ">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ลำดับ</th>
                                                <th>รหัสประจำตัว</th>
                                                <th>ชื่อ - สกุล</th>
                                                <th>ขอใช้ห้อง</th>
                                                <th class="text-center">ตรวจสอบ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>1339900662225</td>
                                                <td>SOMPHOL WILA</td>
                                                <td>วิทยาการ 3012</td>
                                                <td class="text-center">
                                                    <a  href="#" onclick="window.confirm('Press OK to close this option')"><i class="ti-check color-success" ></i></a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a href="#" onclick="window.confirm('Press OK to close this option')"><i class="ti-close color-danger"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td>1339900662225</td>
                                                <td>สมผล เจริฐพร</td>
                                                <td>วิทยาการ 30182</td>
                                                <td class="text-center">
                                                    <a  href="#" onclick="window.confirm('Press OK to close this option')"><i class="ti-check color-success" ></i></a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a href="#" onclick="window.confirm('Press OK to close this option')"><i class="ti-close color-danger"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>













                <section id="main-content">

                    <?php
                    // include_once("./report_dasboard_ad.php")
                    ?>

                </section>

            </div>
        </div>
    </div>


</body>

</html>