<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar_ad.php");
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Management Rooms Admin Dashboard</title>
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
                                    <li class="breadcrumb-item"><a href="./room_history_all.php">Management Room</a></li>
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
                                                    <th>เวลา เข้า</th>
                                                    <th class="text-center">เช็ค</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $sql = "SELECT mm.id_mem ,mm.id_code, mm.name ,mm.last_name ,rm.room_num, sc.time_stamp FROM `schedule` as sc INNER JOIN members as mm ON sc.id_mem = mm.id_mem INNER JOIN rooms as rm ON sc.id_room = rm.id_room;";
                                                $search = Database::query($sql, PDO::FETCH_ASSOC);
                                                foreach($search as $row):
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['id_code']?></td>
                                                    <td><?php echo $row['name']." ".$row['last_name']?></td>
                                                    <td><?php echo $row['room_num']?></td>
                                                    <td><?php echo $row['time_stamp']?></td>
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
                                <p>2018 © Admin Board. - <a href="#">example.com</a></p>
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
                        'copy', 'csv', 'excel', 'print'
                    ]
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