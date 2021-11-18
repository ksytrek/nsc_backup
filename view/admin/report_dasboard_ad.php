<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<?php
// include_once('../../config/connectdb.php');
try {
    $row_rom = Database::query("SELECT COUNT(*) as total FROM `rooms`;", PDO::FETCH_ASSOC)->fetch();
    $row_persona = Database::query("SELECT COUNT(*) as total FROM members;", PDO::FETCH_ASSOC)->fetch();
    $row_rqroom = Database::query("SELECT COUNT(*) as total FROM rqroom;", PDO::FETCH_ASSOC)->fetch();
    $row_schedule = Database::query("SELECT COUNT(*) as total FROM schedule;", PDO::FETCH_ASSOC)->fetch();
} catch (Exception $e) {
    echo $e->getMessage();
    // echo "<script>alert( '{$error}')</script>";
}
?>

<body>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <!-- /# row -->
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card bg-warning">
                            <div class="stat-widget-six">
                                <div class="stat-icon">
                                    <i class="ti-stats-up"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-heading">จำนวนบุคลากร</div>
                                        <div class="stat-text">Total: <?php echo $row_persona['total'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-primary">
                            <div class="stat-widget-six">
                                <div class="stat-icon">
                                    <i class="ti-bolt-alt"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-heading">จำนวนห้อง</div>
                                        <div class="stat-text">Total: <?php echo $row_rom['total'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-warning">
                            <div class="stat-widget-six">
                                <div class="stat-icon">
                                    <i class="ti-stats-up"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-heading">จำนวนที่ร้องขอ</div>
                                        <div class="stat-text">Total: <?php echo $row_rqroom['total'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card bg-primary">
                            <div class="stat-widget-six">
                                <div class="stat-icon">
                                    <i class="ti-bolt-alt"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-heading">จำนวนประวัติใช้ห้อง</div>
                                        <div class="stat-text">Total : <?php echo $row_schedule['total'] ?> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>สถานะห้อง</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover " id="tb_showroom">
                                        <thead>
                                            <tr>
                                                <th>ชื่อห้อง</th>
                                                <th>สถานะไฟ</th>
                                                <th class="text-center">จำนวนที่มีสิทธิ์เข้า</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbb_showroom">
                                            <!-- <tr>
                                                <td>Kolor Tea Shirt For Man</td>
                                                <td>
                                                    <button class="btn badge badge-danger">Off</button>
                                                </td>
                                                <td class="text-center">22</td>

                                            </tr>
                                            <tr>
                                                <td>Kolor Tea Shirt For Women</td>
                                                <td>
                                                    <button class="btn badge badge-success">On</button>
                                                </td>
                                                <td class="text-center">30</td>

                                            </tr>
                                            <tr>
                                                <td>Blue Backpack For Baby</td>
                                                <td>
                                                    <button class="btn badge badge-danger">Off</button>
                                                </td>
                                                <td class="text-center"> 25</td>

                                            </tr> -->
                                        </tbody>
                                        <?php
                                                function shom_id_room($id_room){
                                                    // echo $id_room; 
                                                    $show_tebelig = Database::query("SELECT count(*) as total  FROM `schedule`  WHERE `id_room` = '{$id_room}';", PDO::FETCH_ASSOC);
                                                    if ($row = $show_tebelig -> fetch()) {
                                                        return $row['total'];
                                                    } else {
                                                        return "ยังไม่มีสิทธิ์เข้าห้อง";
                                                    }     
                                                }
                                        ?>
                                        <script>
                                            window.onload = function() {
                                                tb_showroom();
                                            };

                                            setInterval(function() {
                                                tb_showroom();
                                            }, 5000); // 1000 = 1 second

                                            var sta = "";

                                            function el_sum(id_room) {
                                                // var id_room = val["id_room"];
                                                $.ajax({
                                                    url: "./controller/con_admin.php",
                                                    type: "POST",
                                                    data: {
                                                        key: "el_id_room",
                                                        id_room: id_room
                                                    },
                                                    success: function(result, textStatus, jqXHR) {
                                                        sta = result;
                                                    },
                                                    error: function(jqXHR, textStatus, errorThrown) {
                                                        // return errorThrown;
                                                    }
                                                });
                                            }

                                            function tb_showroom() {
                                                var totalel = "";
                                                $.ajax({
                                                    url: "./controller/con_admin.php",
                                                    type: "POST",
                                                    data: {
                                                        key: "tb_showroom"
                                                    },
                                                    success: function(result, textStatus, jqXHR) {
                                                        // alert(result);

                                                        var json = jQuery.parseJSON(result);
                                                        var i = 0;
                                                        if (json != false) {

                                                            $("#tbb_showroom").empty();

                                                            $.each(json, function(key, val) {
                                                                // i += 1;
                                                                var row = "";
                                                                var tr = "<tr>";
                                                                var _tr = "</tr>";
                                                                var td = "<td>";
                                                                var _td = "</td>";
                                                                // var date = new Date(val["time_stamp"]).toLocaleString('th-TH', {
                                                                //     timeZone: 'Asia/Bangkok'
                                                                // });
                                                                // console.log(date);

                                                                // el_sum(val['id_room']) ;

                                                                var status = val["room_fstatus"];
                                                                var btn_status = status == '0' ? "<button class='btn badge badge-danger'>Off</button>" : "<button class='btn badge badge-success'>On</button>";

                                                                // el_sum(val['id_room']);

                                                                // alert("ข้อความ " + sta);

                                                                // alert("ข้อความ ");
                                                                row += tr;
                                                                row += td + val["room_num"] + _td;
                                                                row += td + btn_status + _td;
                                                                row += td + '<'+'?'+'php'+'echo'+ 'shom_id_room('+ val['room_num'] +');'+ '?>' + _td; 
                                                                row += _tr;

                                                                $('#tb_showroom > tbody:last').append(row);
                                                            });
                                                        } else {
                                                            $("#tbb_showroom").empty();
                                                            var row = "";
                                                            var tr = "<tr>";
                                                            var _tr = "</tr>";
                                                            var td = "<td>";
                                                            var _td = "</td>";

                                                            row += tr;
                                                            row += td + "" + _td;
                                                            row += td + "ยังไม่มีข้อมูลสิทธิ์" + el_sum(val["id_room"]) + _td;
                                                            row += _tr;

                                                            $('#tb_showroom  > tbody:last').append(row);
                                                        }
                                                    }
                                                }).error(function(xhr, status, error) {
                                                    alert(xhr.statusText + status + error + ': ' + xhr.responseText);
                                                });

                                            }
                                        </script>

                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->

                </div>
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
                                                    <a href="#" onclick="window.confirm('Press OK to close this option')"><i class="ti-check color-success"></i></a>
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
                                                    <a href="#" onclick="window.confirm('Press OK to close this option')"><i class="ti-check color-success"></i></a>
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>ประวัติการใช้งานห้อง</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>รหัสประจำตัว</th>
                                                <th>ชื่อ - สกุล</th>
                                                <th>ชื่อห้อง</th>
                                                <th class="text-center">เวลา</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>1339900662224</td>
                                                <td>SOMPHOL WILA</td>
                                                <td>January</td>
                                                <td class="color-primary text-center">14:00 10/12/2564</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>1339900662224</td>
                                                <td>SOMPHOL WILA</td>
                                                <td> 30</td>
                                                <td class="color-primary text-center">14:00 10/12/2564</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>1339900662224</td>
                                                <td>SOMPHOL WILA</td>
                                                <td>Jan5</td>
                                                <td class="color-primary text-center">14:00 10/12/2564</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer">
                            <p>2022 © Admin Board. - <a href="#">example.com</a></p>
                        </div>
                    </div>
                </div>
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

    <!-- scripit init-->
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