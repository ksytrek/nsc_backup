<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar_ad.php");
if (isset($_GET['id'])) {
    $id_room = $_GET['id'];
    $sql = "SELECT * FROM `rooms` WHERE id_room = $id_room;";
    $search = Database::query($sql, PDO::FETCH_ASSOC);
    $row_room = $search->fetch();
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Focus Admin: Creative Admin Dashboard</title>

    <link href="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<script>
    const ID_ROOM = '<?php echo $id_room ?>';
    $(document).ready(function() {
        search_room_info();
    });

    function search_room_info() {
        $.ajax({
            url: "./controller/con_room_search_ad.php",
            type: "POST",
            data: {
                key: 'search_room_info',
                id_room: ID_ROOM
            },
            success: function(result, textStatus, jqXHR) {
                // alert(result);
                // swal('เกิดข้อผิดพลาด','success','success');

                var json = JSON.parse(result);

                // alert(json['0']['id_room']);
                $('.name_rooom').html(json[0].room_num);

                $('.info_id_room').html(json[0].id_room);
                $('.info_name_room').html(json[0].room_num)
                $('.info_room_dclose').html(json[0].room_dclose.substr(0, 5));
                $('.info_room_fstatus').html(json[0].room_fstatus == 0 ? '<span class="badge badge-danger">Off</span>' : '<span class="badge badge-success">On</span>');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('ไม่สามารถแสดงข้อมูลได้!!');
                history.back(1);
            }
        });
        // $('.info_room_fstatus').html('<span class="badge badge-success">On</span>');

    }
    // <span class="badge badge-danger">Off</span>
</script>

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
                                    <li class="breadcrumb-item"><a href="./mg_room_ad.php">Management Room</a></li>
                                    <li class="breadcrumb-item active">ตรวจสอบห้อง</li>

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
                                <div class="card-body">
                                    <div class="user-profile">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="user-profile-name">ชื่อห้อง :</div>
                                                <div class="user-profile-name name_rooom"></div>
                                                <div class="user-job-title"></div>

                                                <div class="row">
                                                    <div class="user-send-message">
                                                        <button class="btn btn-sm  btn-success btn-rounded" type="button">
                                                            <i class="ti-zoom-in"></i>&nbsp;&nbsp;เพิ่มสิทธิ์เข้าห้อง</button>
                                                    </div>

                                                </div>
                                                <div class="custom-tab user-profile-tab">
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li role="presentation" class="active">
                                                            <a href="#1" aria-controls="1" role="tab" data-toggle="tab">About</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div role="tabpanel" class="tab-pane active" id="1">
                                                            <div class="contact-information">
                                                                <h4>information</h4>
                                                                <div class="phone-content">
                                                                    <span class="contact-title">รหัสประจำเครื่อง:</span>
                                                                    <span class="contact-skype info_id_room"></span>
                                                                </div>
                                                                <div class="address-content">
                                                                    <span class="contact-title">ชื่อห้อง:</span>
                                                                    <span class="contact-skype info_room_num"></span>
                                                                </div>
                                                                <div class="email-content">
                                                                    <span class="contact-title">เวลาปิด:</span>
                                                                    <span class="contact-email info_room_dclose"></span>
                                                                </div>
                                                                <div class="email-content">
                                                                    <span class="contact-title">สถานะไฟ:</span>
                                                                    <span class="contact-email info_room_fstatus"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="user-send-message">
                                                        <button class="btn btn-info btn-rounded btn-sm" type="button">
                                                            <i class="ti-cloud-down"></i>&nbsp;&nbsp;สำรองข้อมูล</button>
                                                    </div>
                                                    <div class="user-send-message">
                                                        <button class="btn btn-sm btn-warning btn-rounded" type="button" data-toggle="modal" data-target="#edit">
                                                            <i class="ti-hummer"></i>&nbsp;&nbsp;แก้ไข</button>
                                                    </div>
                                                    <div class="user-send-message">
                                                        <button class="btn btn-danger btn-rounded btn-sm  sweet-confirm btn btn-success btn sweet-success btn btn-primary btn sweet-text btn btn-info btn sweet-message btn btn-danger btn sweet-wrong" type="button">
                                                            <i class="ti-alert"></i>&nbsp;&nbsp;ลบห้องนี้</button>
                                                    </div>

                                                    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลส่วนตัว</h5>
                                                                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="false">&times;</span>
                                                                    </button> -->
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form>
                                                                        <div class="form-group">
                                                                            <label>User Name</label>
                                                                            <input type="text" class="form-control" placeholder="User Name">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Last Name</label>
                                                                            <input type="email" class="form-control" placeholder="Last Name">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Email address</label>
                                                                            <input type="email" class="form-control" placeholder="Email">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Password</label>
                                                                            <input type="password" class="form-control" placeholder="Password">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>position</label>

                                                                            <select class="form-control">
                                                                                <option>1</option>
                                                                                <option>2</option>
                                                                                <option>3</option>
                                                                                <option>4</option>
                                                                                <option>5</option>
                                                                            </select>

                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox"> Agree the terms and policy
                                                                            </label>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn btn-primary">SAVE</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section id="main-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-title">
                                        <h4>รายชื่อบุคลากรที่มีสิทธิ์เข้าห้อง</h4>
                                    </div>
                                    <div class="bootstrap-data-table-panel">
                                        <div class="table-responsive">
                                            <table id="tb_room_el" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>รหัสประจำตัว</th>
                                                        <th>ชื่อบุคลากร</th>
                                                        <th class="text-center">รายละเอียด</th>

                                                    </tr>
                                                </thead>
                                                <tbody id='tbb_room_el'>

                                                    <!-- <tr>
                                                        <td>1339900662225</td>
                                                        <td>นายสมพล วิลา</td>
                                                        <th class="text-center">
                                                            <a href="#"><i class="ti-search"></i></a>
                                                        </th>
                                                    </tr> -->

                                                    <!-- <tr>
                                                        <td>1339906884516</td>
                                                        <td>นายรักนะ วรรณะ</td>
                                                        <th class="text-center">

                                                            <a href="#"><i class="ti-search"></i></a>
                                                        </th>
                                                    </tr> -->
                                                </tbody>
                                            </table>
                                            <script>
                                                $(document).ready(function() {
                                                    show_tb_room_el();
                                                    show_tb_room_schedule();
                                                });
                                                function show_tb_room_el(){
                                                    var tb_room_el = $('#tb_room_el').DataTable({
                                                        dom: 'lBfrtip',
                                                        lengthMenu: [
                                                            [5,10, 25, 50,60, -1],
                                                            [5,10, 25, 50, 60,"All"]
                                                        ],
                                                        buttons: [
                                                            'copy', 'csv', 'excel', 'print'
                                                        ]
                                                    });

                                                    tb_room_el.clear();

                                                    $.ajax({
                                                        url : './controller/con_room_search_ad.php',
                                                        type : 'POST',
                                                        data: {
                                                            key: 'show_tb_room_el',
                                                            id_room : ID_ROOM

                                                        },success: function(result, textStatus, jqXHR) {
                                                            // alert(result);
                                                            var json = JSON.parse(result);
                                                            $.each(json, function(key,val){
                                                                var id_code = val.id_code;
                                                                // val
                                                                tb_room_el.row.add([
                                                                    val.id_code,
                                                                    val.name + ' ' + val.last_name,
                                                                    '<div class="text-center"><a href="./personal_search_ad.php?id='+ val.id_mem + '"><i class="ti-search"></i></a></div>'
                                                                ]).draw(true);
                                                            });
                                                        },error: function(jqXHR, textStatus, errorThrown){

                                                        }
                                                    });

                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <!-- /# card -->
                            </div>
                            <!-- /# column -->
                        </div>
                    </section>
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
                                            <table id="tb_room_schedule" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>รหัสประจำตัว</th>
                                                        <th>ชื่อบุคลากร</th>
                                                        <th>เวลา เข้า</th>
                                                        <th class="text-center">รายละเอียด</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1339900662225</td>
                                                        <td>นายสมพล วิลา</td>
                                                        <td>14:60 น. 12/10/64</td>
                                                        <th class="text-center">

                                                            <a href="#"><i class="ti-search"></i></a>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td>1339906884516</td>
                                                        <td>นายรักนะ วรรณะ</td>
                                                        <td>18:00 น. 12/10/64</td>
                                                        <th class="text-center">

                                                            <a href="#"><i class="ti-search"></i></a>
                                                        </th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <script>
                                                function show_tb_room_schedule(){
                                                    var tb_room_el = $('#tb_room_schedule').DataTable({
                                                        dom: 'lBfrtip',
                                                        lengthMenu: [
                                                            [5,10, 25, 50,60, -1],
                                                            [5,10, 25, 50, 60,"All"]
                                                        ],
                                                        buttons: [
                                                            'copy', 'csv', 'excel', 'print'
                                                        ]
                                                    });

                                                    tb_room_el.clear();

                                                    $.ajax({
                                                        url : './controller/con_room_search_ad.php',
                                                        type : 'POST',
                                                        data: {
                                                            key: 'show_tb_room_schedule',
                                                            id_room : ID_ROOM

                                                        },success: function(result, textStatus, jqXHR) {
                                                            // alert(result);
                                                            var json = JSON.parse(result);
                                                            $.each(json, function(key,val){
                                                                var id_code = val.id_code;
                                                                // val
                                                                tb_room_el.row.add([
                                                                    val.id_code,
                                                                    val.name + ' ' + val.last_name,
                                                                    val.time_stamp,
                                                                    '<div class="text-center"><a href="./personal_search_ad.php?id='+ val.id_mem + '"><i class="ti-search"></i></a></div>'
                                                                ]).draw(true);
                                                            });
                                                        },error: function(jqXHR, textStatus, errorThrown){

                                                        }
                                                    });

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
                                    <p>2022 © Admin Board. - <a href="#">example.com</a></p>
                                </div>
                            </div>
                        </div>
                    </section>
            </div>
        </div>
    </div>



    <!-- <script src="../../script/assets/js/lib/sweetalert/sweetalert.min.js"></script> -->
    <!-- <script src="../../script/assets/js/lib/sweetalert/sweetalert.init.js"></script> -->




    <script src="../../script/assets/js/lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="../../script/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.flash.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.print.min.js"></script>
    <!-- <script src="../../script/assets/js/lib/data-table/datatables-init.js"></script> -->

</body>

</html>