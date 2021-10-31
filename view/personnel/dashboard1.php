<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar.php")
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Focus Admin: Creative Admin Dashboard</title>
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
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">หน้าหลัก</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->

                <script>
                    window.onload = function() {
                        tb_eligibility();
                    };

                    function tb_eligibility() {
                        $.ajax({
                            url: "./controller/con_per.php",
                            type: "POST",
                            data: {
                                tb_elig: "tb_elig",
                                id_men: ""
                            },
                            success: function(result, textStatus, jqXHR) {
                                var json = jQuery.parseJSON(result);
                                if (json != '') {
                                    $("#tbb-eligibility").empty();
                                    $.each(json, function(key, val) {
                                        var row = "";
                                        var tr = "<tr>";
                                        var _tr = "</tr>";
                                        var td = "<td>";
                                        var _td = "</td>";

                                        row += tr;
                                        row += td + val["id_room"] + _td;
                                        row += td + val["room_num"] + _td;
                                        row += _tr;

                                        $('#tb-eligibility > tbody:last').append(row);
                                    });
                                } else {
                                    var row = "";
                                    var tr = "<tr>";
                                    var _tr = "</tr>";
                                    var td = "<td>";
                                    var _td = "</td>";

                                    row += tr;
                                    row += td + "ยังไม่มีข้อมูลสิทธิ์" + _td;
                                    row += _tr;

                                    $('#tb-eligibility > tbody:last').append(row);
                                }
                            }
                        }).error(function(xhr, status, error) {
                            // alert(xhr.statusText + status + error + ': ' + xhr.responseText);
                        }).success(function(result, textStatus, jqXHR) {
                            // alert(result + textStatus + jqXHR.status + ': ' )
                        });

                    }

                    setInterval(function() {
                        getDataFromDb();
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
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ขอใช้ห้อง</th>
                                                    <th>วันที่ร้องขอ</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Kolor Tea Shirt For Man</td>
                                                    <td>14:25 น. 15/12/64</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Kolor Tea Shirt For Women</td>
                                                    <td>14:25 น. 15/12/64</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td>Blue Backpack For Baby</td>
                                                    <td>14:25 น. 15/12/64</td>

                                                </tr>
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
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Salary</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>$320,800</td>
                                        </tr>
                                        <tr>
                                            <td>Garrett Winters</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>$170,750</td>
                                        </tr>
                                        <tr>
                                            <td>Ashton Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>$86,000</td>
                                        </tr>
                                        <tr>
                                            <td>Cedric Kelly</td>
                                            <td>Senior Javascript Developer</td>
                                            <td>Edinburgh</td>
                                            <td>$433,060</td>
                                        </tr>
                                        <tr>
                                            <td>Airi Satou</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>$162,700</td>
                                        </tr>
                                        <tr>
                                            <td>Brielle Williamson</td>
                                            <td>Integration Specialist</td>
                                            <td>New York</td>
                                            <td>$372,000</td>
                                        </tr>
                                        <tr>
                                            <td>Herrod Chandler</td>
                                            <td>Sales Assistant</td>
                                            <td>San Francisco</td>
                                            <td>$137,500</td>
                                        </tr>
                                        <tr>
                                            <td>Rhona Davidson</td>
                                            <td>Integration Specialist</td>
                                            <td>Tokyo</td>
                                            <td>$327,900</td>
                                        </tr>
                                        <tr>
                                            <td>Colleen Hurst</td>
                                            <td>Javascript Developer</td>
                                            <td>San Francisco</td>
                                            <td>$205,500</td>
                                        </tr>
                                        <tr>
                                            <td>Sonya Frost</td>
                                            <td>Software Engineer</td>
                                            <td>Edinburgh</td>
                                            <td>$103,600</td>
                                        </tr>
                                        <tr>
                                            <td>Jena Gaines</td>
                                            <td>Office Manager</td>
                                            <td>London</td>
                                            <td>$90,560</td>
                                        </tr>
                                        <tr>
                                            <td>Quinn Flynn</td>
                                            <td>Support Lead</td>
                                            <td>Edinburgh</td>
                                            <td>$342,000</td>
                                        </tr>
                                        <tr>
                                            <td>Charde Marshall</td>
                                            <td>Regional Director</td>
                                            <td>San Francisco</td>
                                            <td>$470,600</td>
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="footer">
                        <p>2018 © Admin Board. - <a href="#">example.com</a></p>
                    </div>
                </div>
                </section>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    <!-- <script src="../../script/assets/js/lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.js"></script> -->

    <!-- <script src="../../script/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.flash.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/datatables-init.js"></script> -->
    <!-- <script src="../../script/assets/js/lib/jquery.min.js"></script> -->

</body>

</html>