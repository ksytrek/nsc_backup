<head>
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
                                                <th>จำนวนที่มีสิทธิ์เข้า</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbb_showroom">

                                        </tbody>
                                        <script>
                                            window.onload = function() {
                                                tb_showroom();
                                                show_rqroom();

                                            };
                                            $(document).ready(function() {
                                            });


                                            setInterval(function() {
                                                // tb_showroom();
                                                show_rqroom() ;
                                            }, 2000); // 1000 = 1 second


                                            
                                            function tb_showroom() {
                                                var tb_showroom = $('#tb_showroom').DataTable();
                                                    tb_showroom.clear();

                                                $.ajax({
                                                    url: "./controller/con_admin.php",
                                                    type: "POST",
                                                    data: {
                                                        key: "tb_showroom"
                                                    },
                                                    success: function(result, textStatus, jqXHR) {
                                                        // alert(result);
                                                        // console.log(result);
                                                        var json = jQuery.parseJSON(result);

                                                        if (json != false) {
                                                            // $("#tbb_showroom").empty();
                                                            $.each(json, function(key, val) {
                                                                // i += 1;
                                                                var id_room = val['id_room'];
                                                                var room_num = val['room_num'];
                                                                var count = val['count'];
                                                                var status = val["room_fstatus"];
                                                                // var count = val['count'];


                                                                var check_count = count == "0" ? 'ว่าง' : count
                                                                var btn_status;
                                                                if (status == '0') {
                                                                    btn_status = "<button type='button' onclick='ckick_btn_room_fstatus(" + val['id_room'] + ',' + status + ")' class='btn badge badge-danger'>Off</button>";
                                                                } else {
                                                                    btn_status = "<button type='button' onclick='ckick_btn_room_fstatus(" + val['id_room'] + ',' + status + ")'  class='btn badge badge-success'>On</button>";
                                                                }
                                                                
                                                                tb_showroom.row.add([
                                                                    room_num,
                                                                    btn_status,
                                                                    check_count
                                                                ]).draw(true);
                                                                
                                                                // var row = "";
                                                                // var tr = "<tr>";
                                                                // var _tr = "</tr>";
                                                                // var td = "<td>";
                                                                // var _td = "</td>";
                                                                // // var date = new Date(val["time_stamp"]).toLocaleString('th-TH', {
                                                                // //     timeZone: 'Asia/Bangkok'
                                                                // // });
                                                                // // console.log(date);

                                                                // // el_sum(val['id_room']) ;

                                                                // var status = val["room_fstatus"];
                                                                // var btn_status;
                                                                // if (status == '0') {
                                                                //     btn_status = "<button type='button' onclick='ckick_btn_room_fstatus(" + val['id_room'] + ',' + status + ")' class='btn badge badge-danger'>Off</button>";
                                                                // } else {
                                                                //     btn_status = "<button type='button' onclick='ckick_btn_room_fstatus(" + val['id_room'] + ',' + status + ")'  class='btn badge badge-success'>On</button>";
                                                                // }
                                                                // // el_sum(val['id_room']);

                                                                // // alert("ข้อความ " + sta);

                                                                // // alert("ข้อความ ");
                                                                // var count = val['count'];
                                                                // var check_count = count == "0" ? 'ว่าง' : count
                                                                // row += tr;
                                                                // row += td + val["room_num"] + _td;
                                                                // row += td + btn_status + _td;
                                                                // row += td + check_count + _td;
                                                                // row += _tr;

                                                                // $('#tb_showroom > tbody:last').append(row);
                                                            });
                                                        } else {

                                                            tb_showroom.row.add([
                                                                    "",
                                                                    "",
                                                                    "ไม่มีข้อมูลห้อง"
                                                                ]).draw(true);
                                                            // $("#tbb_showroom").empty();
                                                            // var row = "";
                                                            // var tr = "<tr>";
                                                            // var _tr = "</tr>";
                                                            // var td = "<td>";
                                                            // var _td = "</td>";

                                                            // row += tr;
                                                            // row += td + "" + _td;
                                                            // row += td + "ยังไม่มีข้อมูลห้อง" + _td;
                                                            // row += _tr;

                                                            // $('#tb_showroom  > tbody:last').append(row);
                                                        }
                                                    }
                                                }).error(function(xhr, status, error) {
                                                    alert(xhr.statusText + status + error + ': ' + xhr.responseText);
                                                });

                                            }

                                            function ckick_btn_room_fstatus(id_room, status) {

                                                if (confirm(status == "0" ? "you want to turn on the light" : "you want to turn off the light")) {
                                                    $.ajax({
                                                        url: "./controller/con_admin.php",
                                                        type: "POST",
                                                        data: {
                                                            key: "ckick_btn_room_fstatus",
                                                            id_room: id_room,
                                                            status: status
                                                        },
                                                        success: function(result, textStatus, jqXHR) {
                                                            // alert(result)
                                                            swal(result, {
                                                                icon: "success",
                                                                buttons: false,
                                                                timer: 1000,
                                                            });
                                                            tb_showroom();
                                                        },
                                                        error: function(jqXHR, textStatus, errorThrown) {
                                                            alert(errorThrown);
                                                        }
                                                    });
                                                }

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
                        <div id='row_check_rqroom' style="display: none;" class="card">
                            <div class="card-title">
                                <h4>ตรวจสอบการร้องขอของบุคลากร</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover " id="tb_showrqroom">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ลำดับ</th>
                                                <th>รหัสประจำตัว</th>
                                                <th>ชื่อ - สกุล</th>
                                                <th>ขอใช้ห้อง</th>
                                                <th>ตรวจสอบ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbb_showrqroom">
                                        </tbody>

                                    </table>

                                    <script>
                                        function show_rqroom() {
                                            $.ajax({
                                                url: "./controller/con_admin.php",
                                                type: "POST",
                                                data: {
                                                    key: "show_rqroom"
                                                },
                                                success: function(result, textStatus, jqXHR) {
                                                    // alert(result);
                                                    console.log(result);
                                                    var count = 1;
                                                    var json = jQuery.parseJSON(result);
                                                    var i = 0;
                                                    if (json != false) {
                                                        // $('#row_check_rqroom').style
                                                        $("#row_check_rqroom").css("display", "block");
                                                        $("#tbb_showrqroom").empty();
                                                        var name_room = "";
                                                        $.each(json, function(key, val) {
                                                            // i += 1;
                                                            var row = "";
                                                            var tr = "<tr>";
                                                            var _tr = "</tr>";
                                                            var td = "<td>";
                                                            var _td = "</td>";

                                                            row += tr;
                                                            name_room = " " + val["id_code"] + " เข้าห้อง " + val["room_num"] + " ได้ ";

                                                            var click_allow = "<button  type='button'  onclick='click_examine(" + 1 + ',' + val['rq_id'] + ',' + '"' + name_room + '"' + ")' class='btn btn-success btn-flat btn-addon btn-sm m-b-10 m-l-5'><i class='ti-check'></i>Allow</button>" + "&nbsp;&nbsp;&nbsp;&nbsp;" +
                                                                "<button onclick='click_examine(" + 0 + ',' + val['rq_id'] + ',' + '"' + 'ไม่อนุญาติให้ ' + val["id_code"] + 'เข้าห้อง ' + val["room_num"] + '"' + ")' type='button' class='btn btn-danger  btn-flat btn-addon btn-sm m-b-10 m-l-5'><i class='ti-close'></i>Forbid</button>";
                                                            row += td + count + _td;
                                                            row += td + val["id_code"] + _td;
                                                            row += td + val["name"] + "  " + val["last_name"] + _td;
                                                            row += td + val["room_num"] + _td;
                                                            row += td + click_allow + _td;

                                                            row += _tr;
                                                            count++;

                                                            $('#tb_showrqroom > tbody:last').append(row);
                                                        });
                                                    } else {
                                                        $("#tbb_showrqroom").empty();
                                                        var row = "";
                                                        var tr = "<tr>";
                                                        var _tr = "</tr>";
                                                        var td = "<td>";
                                                        var _td = "</td>";

                                                        row += td + "" + _td;
                                                        row += td + "" + _td;
                                                        row += td + "" + _td;
                                                        row += td + "" + _td;
                                                        row += td + "ไม่มีข้อมูล" + _td;

                                                        $('#tb_showrqroom  > tbody:last').append(row);
                                                    }
                                                }
                                            }).error(function(xhr, status, error) {
                                                alert(xhr.statusText + status + error + ': ' + xhr.responseText);
                                            });
                                        }

                                        function click_examine(keyclick, rq_id, name) {
                                            if (keyclick == 1) {
                                                swal({
                                                    title: "Are you sure?",
                                                    text: "ต้องการอนุญาติให้" + name + " ",
                                                    icon: "warning",
                                                    buttons: true,
                                                    dangerMode: true,
                                                }).then((willDelete) => {
                                                    if (willDelete) {
                                                        $.ajax({
                                                            url: "./controller/con_admin.php",
                                                            type: "POST",
                                                            data: {
                                                                key: "click_examine",
                                                                keyclick: keyclick,
                                                                rq_id: rq_id
                                                            },
                                                            success: function(result, textStatus, jqXHR) {
                                                                // alert(result);
                                                                if (result == "OK") {
                                                                    swal("อนุญาติเข้าห้องสำเร็จ", {
                                                                        icon: "success",
                                                                        buttons: false,
                                                                        timer: 1000,
                                                                    });

                                                                } else {
                                                                    alert("error")
                                                                }
                                                            },
                                                            error: function(jqXHR, textStatus, errorThrown) {
                                                                alert("Error: " + errorThrown);
                                                            }
                                                        });
                                                    } else {
                                                        // swal("Your imaginary file is safe!");
                                                    }
                                                });
                                            } else {
                                                swal({
                                                    title: "Are you sure?",
                                                    text: name + " ",
                                                    icon: "warning",
                                                    buttons: true,
                                                    dangerMode: true,
                                                }).then((willDelete) => {
                                                    if (willDelete) {
                                                        $.ajax({
                                                            url: "./controller/con_admin.php",
                                                            type: "POST",
                                                            data: {
                                                                key: "click_examine",
                                                                keyclick: keyclick,
                                                                rq_id: rq_id
                                                            },
                                                            success: function(result, textStatus, jqXHR) {
                                                                // alert(result);
                                                                if (result == "cancel") {
                                                                    swal("ปฏิเสธเข้าห้องสำเร็จ", {
                                                                        icon: "success",
                                                                        buttons: false,
                                                                        timer: 1000,
                                                                    });
                                                                } else {
                                                                    alert("error")
                                                                }
                                                            },
                                                            error: function(jqXHR, textStatus, errorThrown) {
                                                                alert("Error: " + errorThrown);
                                                            }
                                                        });
                                                    } else {
                                                        // swal("Your imaginary file is safe!");
                                                    }
                                                });
                                            }


                                        }
                                        // function click_examine_forbid(){
                                        //     alert("forbid");
                                        // }
                                    </script>
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
                                    <table class="table table-hover" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>รหัสประจำตัว</th>
                                                <th>ชื่อ - สกุล</th>
                                                <th>ชื่อห้อง</th>
                                                <th>เวลา</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $num = 0;
                                            $sql = Database::query("SELECT mm.id_code, mm.name,mm.last_name,rm.room_num , sc.time_stamp FROM `schedule` as sc INNER JOIN members as mm ON sc.id_mem = mm.id_mem INNER JOIN rooms as rm ON sc.id_room = rm.id_room;", PDO::FETCH_ASSOC);
                                            foreach ($sql as $row) :
                                                $num += 1;
                                            ?>
                                                <tr>
                                                    <th scope="row"><?php echo $num; ?></th>
                                                    <td><?php echo $row['id_code'] ?></td>
                                                    <td><?php echo $row['name'] . " " . $row['last_name'] ?></td>
                                                    <td><?php echo $row['room_num'] ?></td>
                                                    <td class="color-primary text-center"><?php echo date("H:i d/m/Y", strtotime($row['time_stamp'])); ?></td>
                                                </tr>
                                            <?php
                                            endforeach;
                                            ?>
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

    <!-- scripit init-->
    <script src="../../script/assets/js/lib/data-table/datatables.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.flash.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/datatables-init.js"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    <script src="../../script/assets/js/lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.js"></script>



</body>

</html>