<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar_ad.php")
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Focus Admin: Creative Admin Dashboard</title>
    <!-- <link href="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
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
                                    <li class="breadcrumb-item"><a href="./backup_data_room.php">BackUp</a></li>
                                    <li class="breadcrumb-item active">BackUp Room</li>
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
                                <h4>รายชื่อห้องและประวัติการใช้งาน</h4>
                                <h6 class="user-job-title">อัพเดตล่าส่งวันที่ 16/10/64</h6>
                            </div>
                            <button type="button" class="btn btn-info btn-flat btn-addon btn-md m-b-10 m-l-5"><i class="ti-cloud-down"></i>สำรองข้อมูลห้อง + ประวัติการใช้งาน</button>
                            <div class="row">

                                <div class="col-lg-3">
                                    <div class="card">
                                        <div class="stat-widget-four">
                                            <div class="stat-icon">
                                                <i class="ti-user"></i>
                                            </div>
                                            <div class="stat-content">
                                                <div class="text-left dib">
                                                    <div class="stat-heading">Room</div>
                                                    <div class="stat-text">Total: 220</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="card">
                                        <div class="stat-widget-four">
                                            <div class="stat-icon">
                                                <i class="ti-pulse"></i>
                                            </div>
                                            <div class="stat-content">
                                                <div class="text-left dib">
                                                    <div class="stat-heading">Schedule</div>
                                                    <div class="stat-text">Total: 24720</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-title">
                                <h4>รายชื่อห้อง</h4>
                                <h6 class="user-job-title">อัพเดตล่าส่งวันที่ 16/10/64</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="tb_room_list" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>รหัสประจำเครื่อง</th>
                                                <th>ชื่อห้อง</th>
                                                <th>จำนวนครั้งที่เข้า</th>
                                                <th>จำนวนบุคลากรมีสิทธิ์เข้า</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <script>
                                        $(document).ready(function() {
                                            tb_room_list();
                                        });

                                        function tb_room_list() {
                                            var tb_room_list = $('#tb_room_list').DataTable({
                                                // dom: 'lBfrtip',
                                                lengthMenu: [
                                                    [5, 10, 25, 50, 60, -1],
                                                    [5, 10, 25, 50, 60, "All"]
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

                                                // sInfoEmpty: "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                                                // processing: true, // แสดงข้อความกำลังดำเนินการ กรณีข้อมูลมีมากๆ จะสังเกตเห็นง่าย
                                                // //serverSide: true, // ใช้งานในโหมด Server-side processing
                                                // order: [], // กำหนดให้ไม่ต้องการส่งการเรียงข้อมูลค่าเริ่มต้น จะใช้ค่าเริ่มต้นตามค่าที่กำหนดในไฟล์ php
                                                // retrieve: true,
                                            });

                                            tb_room_list.clear();

                                            $.ajax({
                                                url : "",
                                                type : "POST",
                                                data: {
                                                    key : 'tb_room_list'
                                                },success : function(result, textStatus, jqXHR) {

                                                    var count = 1;
                                                    var json = jQuery.parseJSON(result);
                                                    $.each(json, function(key, value) {

                                                        var col1 = count ;
                                                        var col2 = '';
                                                        var col3 = '';
                                                        var col4 = '';
                                                        var col5 = '';

                                                        tb_room_list.row.add([
                                                            col1,col2,col3,col4,col5
                                                        ]).draw(true);
                                                        count++;
                                                    });


                                                },error : function(result, textStatus, jqXHR){

                                                }
                                            });


                                        }
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
                                <h4>ประวัติการใช้งาน</h4>
                                <h6 class="user-job-title">อัพเดตล่าส่งวันที่ 16/10/64</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="tb_schedule_back" class="table  table-hover">
                                        <thead>
                                            <tr>
                                                <th>รหัสประจำตัว</th>
                                                <th>ชื่อ - สกุล</th>
                                                <th>เบอร์ติดต่อ</th>
                                                <th>ห้องใช้งาน</th>
                                                <th>เวลาเข้า</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                            <tr>
                                                <td>1339900662224</td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                                <td>วิทยาการ 304</td>
                                                <td>09:25 น. 18/10/64 </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                    <script>
                                        $(document).ready(function() {
                                            tb_schedule_back();
                                        });

                                        function tb_schedule_back() {
                                            var tb_schedule_back = $('#tb_schedule_back').DataTable({
                                                dom: 'lBfrtip',
                                                lengthMenu: [
                                                    [5, 10, 25, 50, 60, -1],
                                                    [5, 10, 25, 50, 60, "All"]
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
                                                processing: true, // แสดงข้อความกำลังดำเนินการ กรณีข้อมูลมีมากๆ จะสังเกตเห็นง่าย
                                                serverSide: false, // ใช้งานในโหมด Server-side processing
                                                order: [], // กำหนดให้ไม่ต้องการส่งการเรียงข้อมูลค่าเริ่มต้น จะใช้ค่าเริ่มต้นตามค่าที่กำหนดในไฟล์ php
                                                buttons: [{
                                                    extend: 'excel',
                                                    text: 'ส่งออก EXCEL',
                                                    messageTop: 'Cybernetics Corp.',
                                                    // filename: function() {
                                                    //     // const d = new Date();
                                                    //     // // let time = d.getTime();
                                                    //     // let hour = d.getHours();
                                                    //     // let minutes = d.getMinutes();
                                                    //     // let day = d.getDay();
                                                    //     // let month = d.getMonth();
                                                    //     // let year = d.getFullYear();
                                                    //     return "รายชื่อบุคลากรที่มีสิทธิ์เข้าห้อง"; //+hour+'-'+minutes + '-'+days +'-'+month +'-'+years
                                                    // },
                                                    title: 'รายชื่อสิทเข้าห้อง',
                                                    exportOptions: {
                                                        columns: [0, 4],
                                                        // คอลัมส์ที่จะส่งออก
                                                        // modifier: {
                                                        //     page: 'all' // หน้าที่จะส่งออก all / current
                                                        // },
                                                        // stripHtml: true
                                                    }
                                                }],
                                                retrieve: true,
                                            });


                                            tb_schedule_back.clear();


                                            $.ajax({
                                                url : 'tb_schedule_back',
                                                type : 'POST',
                                                data: {

                                                },success: function(result, textStatus, jqXHR) {


                                                    var count = 1;
                                                    var json = jQuery.parseJSON(result);
                                                    $.each(json, function(key, value) {

                                                        var col1 = count ;
                                                        var col2 = '';
                                                        var col3 = '';
                                                        var col4 = '';
                                                        var col5 = '';

                                                        tb_room_list.row.add([
                                                            col1,col2,col3,col4,col5
                                                        ]).draw(true);
                                                        count++;
                                                    });



                                                    
                                                },error: function(result, textStatus, jqXHR){

                                                }
                                            });
                                        }
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

    <!-- <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script> -->
    <!-- <script src="../../script/assets/js/lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.js"></script> -->

    <!-- <script src="../../script/assets/js/lib/data-table/datatables.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.flash.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/datatables-init.js"></script>


    <script src="../../script/assets/js/lib/data-table-back/datatables.min.js"></script>
    <script src="../../script/assets/js/lib/data-table-back/dataTables.buttons.min.js"></script>
    <script src="../../script/assets/js/lib/data-table-back/buttons.flash.min.js"></script>
    <script src="../../script/assets/js/lib/data-table-back/jszip.min.js"></script>
    <script src="../../script/assets/js/lib/data-table-back/pdfmake.min.js"></script>
    <script src="../../script/assets/js/lib/data-table-back/vfs_fonts.js"></script>
    <script src="../../script/assets/js/lib/data-table-back/buttons.html5.min.js"></script>
    <script src="../../script/assets/js/lib/data-table-back/buttons.print.min.js"></script>
    <script src="../../script/assets/js/lib/data-table-back/datatables-init.js"></script> -->

    <script src="../../script/assets/js/lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="../../script/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.flash.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/vfs_fonts.js"></script>
    <!-- <script src="../../script/vfs_fonts.js"></script> -->
    <script src="../../script/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.print.min.js"></script>




</body>

</html>