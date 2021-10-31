<!DOCTYPE html>
<html lang="en">
<?php

// session_start();
// include('../../config/connectdb.php');
// $id_mem =  $_SESSION["id_mem"];

?>

<head>
    <meta charset="utf-8">

    <link href="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <!-- /# row -->
                <script>
                    window.onload = function() {
                        tb_eligibility();
                        tb_rqroom();
                    };

                    function tb_eligibility() {
                        $.ajax({
                            url: "./controller/con_per.php",
                            type: "POST",
                            data: {
                                tb_elig: "tb_elig",
                                id_mem: "<?php echo $id_mem ?>"
                            },
                            success: function(result, textStatus, jqXHR) {
                                var json = jQuery.parseJSON(result);
                                // alert(result);
                                var i = 0;
                                if (json != false) {
                                    $("#tbb-eligibility").empty();
                                    $.each(json, function(key, val) {
                                        i += 1;
                                        var row = "";
                                        var tr = "<tr>";
                                        var _tr = "</tr>";
                                        var td = "<td>";
                                        var _td = "</td>";

                                        row += tr;
                                        row += td + i + _td;
                                        row += td + val["room_num"] + _td;
                                        row += _tr;

                                        $('#tb-eligibility > tbody:last').append(row);
                                    });
                                } else {
                                    $("#tbb-eligibility").empty();
                                    var row = "";
                                    var tr = "<tr>";
                                    var _tr = "</tr>";
                                    var td = "<td>";
                                    var _td = "</td>";

                                    row += tr;
                                    row += td + "" + _td;
                                    row += td + "ยังไม่มีข้อมูลสิทธิ์" + _td;
                                    row += _tr;

                                    $('#tb-eligibility > tbody:last').append(row);
                                }
                            }
                        }).error(function(xhr, status, error) {
                            // alert(xhr.statusText + status + error + ': ' + xhr.responseText);
                        });

                    }

                    function formatDate(dateString) {
                        var allDate = dateString.split(' ');
                        var thisDate = allDate[0].split('-');
                        var thisTime = allDate[1].split(':');
                        var newDate = [thisDate[2], thisDate[1], thisDate[0]].join("-");

                        var suffix = thisTime[0] >= 12 ? "PM" : "AM";
                        var hour = thisTime[0] > 12 ? thisTime[0] - 12 : thisTime[0];
                        var hour = hour < 10 ? "0" + hour : hour;
                        var min = thisTime[1];
                        var sec = thisTime[2];
                        var newTime = hour + ':' + min + suffix;

                        return newTime + ' ' + newDate;
                    }

                    function tb_rqroom() {
                        $.ajax({
                            url: "./controller/con_per.php",
                            type: "POST",
                            data: {
                                tb_rqroom: "tb_rqroom",
                                id_mem: "<?php echo $id_mem ?>"
                            },
                            success: function(result, textStatus, jqXHR) {
                                var json = jQuery.parseJSON(result);
                                // alert(result);
                                var i = 0;
                                if (json != false) {
                                    $("#tbb_rqroom").empty();
                                    $.each(json, function(key, val) {
                                        i += 1;
                                        var row = "";
                                        var tr = "<tr>";
                                        var _tr = "</tr>";
                                        var td = "<td>";
                                        var _td = "</td>";
                                        var date = new Date(val["time_stamp"]).toLocaleString('th-TH', {
                                            timeZone: 'Asia/Bangkok'
                                        });
                                        // console.log(date);
                                        row += tr;
                                        row += td + i + _td;
                                        row += td + val["room_num"] + _td;
                                        row += td + formatDate(val["time_stamp"]) + _td;
                                        row += _tr;

                                        $('#tb_rqroom > tbody:last').append(row);
                                    });
                                } else {
                                    $("#tbb_rqroom").empty();
                                    var row = "";
                                    var tr = "<tr>";
                                    var _tr = "</tr>";
                                    var td = "<td>";
                                    var _td = "</td>";

                                    row += tr;
                                    row += td + "" + _td;
                                    row += td + "ยังไม่มีข้อมูลสิทธิ์" + _td;
                                    row += _tr;

                                    $('#tb-eligibility > tbody:last').append(row);
                                }
                            }
                        }).error(function(xhr, status, error) {
                            // alert(xhr.statusText + status + error + ': ' + xhr.responseText);
                        });

                    }

                    setInterval(function() {
                        tb_eligibility();
                        tb_rqroom();
                        // updateTB();
                        // tb_schedule();
                    }, 1000); // 1000 = 1 second
                </script>
                <section id="main-content">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-title">
                                    <h4>แสดงข้อมูลที่มีสิทธิ์ใช้ห้อง</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table-striped">
                                        <table class="table" id="tb-eligibility">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ห้องที่มีสิทธิ์เข้า</th>

                                                </tr>
                                            </thead>
                                            <tbody id="tbb-eligibility">

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-title">
                                    <h4>แสดงข้อมูลต้องการขอใช้ห้อง</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="tb_rqroom">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ขอใช้ห้อง</th>
                                                    <th>วันที่ร้องขอ</th>

                                                </tr>
                                            </thead>
                                            <tbody id="tbb_rqroom">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->

                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-title">
                            <h4>แสดงข้อมูลประวัติการใช้ห้อง</h4>
                        </div>
                        <div class="bootstrap-data-table-panel">
                            <div class="table-responsive">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <!-- <th>Position</th> -->
                                            <th>ห้องที่เข้า</th>
                                            <th>เวลาเข้าห้อง</th>
                                        </tr>
                                    </thead>

                                    <tbody id="tbb_schedule">
                                        <?php
                                        $tb_schedule_result = "";
                                        if ($show_tebelig = Database::query("SELECT rm.room_num ,sc.time_stamp FROM `schedule` as sc inner join `rooms` as rm on sc.id_room = rm.id_room  where sc.id_mem = '{$id_mem}' ORDER BY sc.time_stamp  ASC;", PDO::FETCH_ASSOC)) {
                                            $i = 0;
                                            foreach ($show_tebelig as $row) {
                                                $i = $i + 1;
                                                $date = date("H:i d/m/Y", strtotime($row['time_stamp']));
                                                $tb_schedule_result = $tb_schedule_result.
                                                "<tr>
                                                    <td>$i</td>
                                                    <td>{$row['room_num']}</td>
                                                    <td>{$date}</td>
                                                </tr>";
                                            }
                                        }

                                        echo $tb_schedule_result;
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

    <script>
        // $(document).ready(function() {
        //     $('#dataTable').DataTable();
        // });
        // $('#bootstrap-data-table').DataTable({
        // dom: 'lBfrtip',
        // lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // buttons: [
        //     'copy', 'csv', 'excel', 'print'
        // ]
        // });
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
    <script src="../../script/assets/js/lib/data-table/datatables-init.js"></script>
    <script src="../../script/assets/js/lib/jquery.min.js"></script>

</body>

</html>