<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar_ad.php");

// $id_mem = $_GET['id'];

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>บันทึกภาพใบหน้า</title>

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
                                    <li class="breadcrumb-item"><a href="./on_face_name.php">จัดการบุคลากร</a></li>
                                    <li class="breadcrumb-item active">บันทึกภาพใบหน้า</li>
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
                                        <table class="table table-bordered" id="dataTable_no_face">
                                            <thead>
                                                <tr>
                                                    <th>รหัสประจำตัว</th>
                                                    <th>ชื่อ - สกุล</th>
                                                    <th>Position</th>
                                                    <th class="text-center">อัพโหลด</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <script>
                                            $(document).ready(function() {
                                                DataTable_on_face();
                                            });

                                            function DataTable_on_face() {
                                                var dataTable_no_face = $('#dataTable_no_face').DataTable({
                                                    language: {
                                                        sProcessing: "กำลังดำเนินการ...",
                                                        sLengthMenu: "แสดง_MENU_ แถว",
                                                        sZeroRecords: "ไม่พบข้อมูล",
                                                        sInfo: "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                                                        sInfoEmpty: "แสดง 0 ถึง 0 จาก 0 แถว",
                                                        sInfoFiltered: "(กรองข้อมูล _MAX_ ทุกแถว)",
                                                        sInfoPostFix: "",
                                                        sSearch: "ค้นหา:",
                                                        sUrl: "",
                                                        oPaginate: {
                                                            "sFirst": "เริ่มต้น",
                                                            "sPrevious": "ก่อนหน้า",
                                                            "sNext": "ถัดไป",
                                                            "sLast": "สุดท้าย"
                                                        }
                                                    },
                                                });
                                                dataTable_no_face.clear();

                                                $.ajax({
                                                    url: './controller/con_on_face_name.php',
                                                    type: 'POST',
                                                    data: {
                                                        key: 'DataTable_on_face'
                                                    },
                                                    success: function(result, textStatus, jqXHR) {
                                                        // alert(result);
                                                        var json = JSON.parse(result);
                                                        $.each(json, function(key, val) {

                                                            var col1 = val['id_code'];
                                                            var col2 = val['name'] + " " + val['last_name'];
                                                            var col3 = val['position'];
                                                            var col4 = "<div class='text-center'><button type='button' onclick='click_save_face(" + val['id_mem'] + ")' class='btn badge badge-danger'>UPLOAD</button></div>";
                                                            dataTable_no_face.row.add([
                                                                col1, col2, col3, col4
                                                            ]).draw(true);
                                                        });

                                                    },
                                                    error: function(result, textStatus, jqXHR) {

                                                    }
                                                });




                                            }

                                            function click_save_face(id_mem) {
                                                // alert(id_mem);
                                                if (confirm("Are you sure you want to save")) {
                                                    location.assign('./on_save_face.php?id=' + id_mem);
                                                }

                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <!-- /# card -->
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p>2022 © ITT Software.</p>
                            </div>
                        </div>
                    </div>

                    <?php
                    // include_once("./report_dasboard_ad.php")
                    ?>

                </section>

            </div>
        </div>
    </div>


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