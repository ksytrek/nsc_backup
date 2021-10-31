<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar_ad.php")
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Face Admin Dashboard</title>

    <link href="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../../script/assets/css/lib/sweetalert/sweetalert.css" rel="stylesheet">
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
                                    <li class="breadcrumb-item"><a href="./on_face_name.php">Management</a></li>
                                    <li class="breadcrumb-item active">Save Face</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title">
                                    <h4>รายชื่อบุคลากรที่ยังไม่อัพโหลดภาพ</h4>
                                </div>
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>รหัสประจำตัว</th>
                                                    <th>ชื่อ - สกุล</th>
                                                    <th>Position</th>
                                                    <th class="text-center">อัพโหลด</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1339900662225</td>
                                                    <td>นายสมพล วิลา</td>
                                                    <td>นักศึกษาฝึกงาน</td>
                                                    <td class="text-center"><a href="./on_save_face.php"><span class="badge badge-danger ">Upload</span></a></td>

                                                </tr>
                                                <tr>
                                                    <td>1339906884516</td>
                                                    <td>นายรักนะ วรรณะ</td>
                                                    <td>นักศึกษาฝึกงาน</td>
                                                    <td class="text-center"><a href="./on_save_face.php"><span class="badge badge-danger">Upload</span></a></td>

                                                </tr>
                                                <tr>
                                                    <td>1339906884516</td>
                                                    <td>นายรักนะ วรรณะ</td>
                                                    <td>นักศึกษาฝึกงาน</td>
                                                    <td class="text-center"><a href="./on_save_face.php"><span class="badge badge-danger">Upload</span></a></td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /# card -->
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->


                    <?php
                    // include_once("./report_dasboard_ad.php")
                    ?>

                </section>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    <script src="../../script/assets/js/lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.js"></script>


    <script src="../../script/assets/js/lib/sweetalert/sweetalert.min.js"></script>
    <script src="../../script/assets/js/lib/sweetalert/sweetalert.init.js"></script>
    <script src="../../script/assets/js/lib/bootstrap.min.js"></script>
    <script src="../../script/assets/js/scripts.js"></script>

    <!-- <script src="../../script/assets/js/lib/data-table/datatables.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.flash.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/datatables-init.js"></script> -->
</body>

</html>