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
                                        $(document).ready(function(){
                                            show_rqroom();
                                        });
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

            </div>
        </div>
    </div>


</body>

</html>