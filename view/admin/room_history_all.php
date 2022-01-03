<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar_ad.php");
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ประวัติการเข้าห้อง</title>
    <!-- <link href="assets/css/lib/data-table/buttons.bootstrap.min.css" rel="stylesheet" /> -->
    <link href="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                                    <li class="breadcrumb-item"><a href="./room_history_all.php">จัดการห้อง</a></li>
                                    <li class="breadcrumb-item active">ประวัติเข้าห้อง</li>
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
                                    <h4>ประวัติการเข้าห้อง</h4>
                                </div>
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="bootstrap-data-table-export" class="display table table-borderd table-hover">
                                            <thead>
                                                <tr>
                                                    <th>รหัสประจำตัว</th>
                                                    <th>ชื่อบุคลากร</th>
                                                    <th>ชื่อห้อง</th>
                                                    <th class="text-center">เวลา เข้า</th>
                                                    <th class="text-center">เช็ค</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM `schedule` as sc ORDER BY time_stamp DESC ;";
                                                $search = Database::query($sql, PDO::FETCH_ASSOC);
                                                foreach ($search as $row) :
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['id_code'] ?></td>
                                                        <td><?php echo $row['full_name'] ?></td>
                                                        <td><?php echo $row['room_name'] ?></td>
                                                        <td class="color-primary text-center"><?php echo date("H:i  d/m/Y", strtotime($row['time_stamp'])) ?></td>
                                                        <td class="text-center">
                                                            <a href="./personal_search_ad.php?id=<?php echo $row['id_mem'] ?>"><i class="ti-search"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                endforeach;
                                                ?>
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

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p>2022 © ITT Software.</p>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- scripit init-->

    <script>
        $(document).ready(function() {
            // $('#bootstrap-data-table-export').DataTable();
            $('#bootstrap-data-table-export').DataTable({
                dom: 'lBfrtip',
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                buttons: [
                    'excel'
                ],
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
        });
    </script>
    <script src="../../script/assets/js/lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="../../script/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.flash.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.print.min.js"></script>
</body>

</html>