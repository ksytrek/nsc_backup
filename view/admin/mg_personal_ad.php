<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar_ad.php");
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Management Personal Dashboard</title>

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
                                    <li class="breadcrumb-item"><a href="./mg_personal_ad.php">Management</a></li>
                                    <li class="breadcrumb-item active">จัดการตารางบุคลากร</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- row -->

                <section id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title">
                                    <h4>จัดการตารางบุคลากร</h4>
                                </div>
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <!-- table table-bordered -->
                                        <!-- <table id="bootstrap-data-table-export" class="table table-striped table-bordered"> -->
                                        <table class="table table-hover" id="show_tb_mg_personal">
                                            <thead>
                                                <tr>
                                                    <th>รหัสประจำตัว</th>
                                                    <th>ชื่อ - สกุล</th>
                                                    <th>Position</th>
                                                    <th>เบอร์ติดต่อ</th>
                                                    <th class="text-center">
                                                        <a href="#" data-toggle="modal" data-target="#add_personal"><i class="ti-plus">&nbsp;เพิ่ม</i></a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1339900662225</td>
                                                    <td>นายสมพล วิลา</td>
                                                    <td>นักศึกษาฝึกงาน</td>
                                                    <td class="text-center"><button class="btn badge badge-danger">NO</button></td>
                                                    <th class="text-center">
                                                        <a href="#" data-toggle="modal" data-target="#edit_personal"><i class="ti-pencil"></i></a>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <a href="./personal_search_ad.php"><i class="ti-search"></i></a>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td>1339906884516</td>
                                                    <td>นายรักนะ วรรณะ</td>
                                                    <td>นักศึกษาฝึกงาน</td>
                                                    <td class="text-center"><button class="btn badge badge-success">yes</button></td>
                                                    <th class="text-center">
                                                        <a href="#" data-toggle="modal" data-target="#edit_personal"><i class="ti-pencil"></i></a>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <a href="./personal_search_ad.php"><i class="ti-search"></i></a>
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <script>
                                            $(document).ready(function() {
                                                show_tb_mg_personal();
                                            });

                                            function show_tb_mg_personal() {
                                                var show_tb_mg_personal = $('#show_tb_mg_personal').DataTable({
                                                    // dom: 'lBfrtip',
                                                    lengthMenu: [
                                                        [10, 25, 50, 60, -1],
                                                        [10, 25, 50, 60, "All"]
                                                    ],
                                                    // buttons: ['copy', 'csv', 'excel', 'print'],
                                                    retrieve: true,
                                                });
                                                show_tb_mg_personal.clear(); //
                                                $.ajax({
                                                    url: './controller/con_mg_personal_ad.php',
                                                    type: 'POST',
                                                    data: {
                                                        key: 'show_tb_mg_personal',

                                                    },
                                                    success: function(result, textStatus, jqXHR) {
                                                        // alert(result);
                                                        var json = JSON.parse(result);
                                                        $.each(json, function(key, val) {

                                                            var col1 = val['id_code'];
                                                            var col2 = val['name'] + " " + val['last_name'];
                                                            var col3 = val['position'];
                                                            var col4 = val['phone'];
                                                            var col5 = '<div class="text-center"><a href="./personal_search_ad.php?id=' + val['id_mem'] + '"><i class="ti-search"></i></a></div>';
                                                            show_tb_mg_personal.row.add([
                                                                col1, col2, col3, col4, col5
                                                            ]).draw(true);

                                                        });
                                                    },
                                                    error: function(result, textStatus, jqXHR) {
                                                        show_tb_mg_personal.row.add([
                                                            '', '', '', '', 'ไม่มีข้อมูลบุคลากร'
                                                        ]).draw(true);
                                                    }
                                                });

                                            }
                                        </script>
                                    </div>
                                </div>

                                <div class="modal fade" id="add_personal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลส่วนตัว</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group form-group-id">
                                                        <label>รหัสประจำตัว</label>
                                                        <input type="text" class="form-control add-input-id_code" placeholder="รหัสประจำตัว">
                                                        <p id="txt-id">กรุณากรอกรหัสประจำตัว 13 หลัก</p>

                                                    </div>
                                                    <div class="form-group form-group-name">
                                                        <label>User Name</label>
                                                        <input type="text" class="form-control add-input-name" placeholder="User Name">
                                                        <p id="txt-name">กรุณากรอกชื่อตามความจริง</p>

                                                    </div>
                                                    <div class="form-group form-group-last_name">
                                                        <label>Last Name</label>
                                                        <input type="email" class="form-control add-input-last_name" placeholder="Last Name">
                                                        <p id="txt-last_name">กรุณากรอกนามสกุลตามความจริง</p>

                                                    </div>

                                                    <div class="form-group form-group-e_mail">
                                                        <label>Email address</label>
                                                        <input type="email" class="form-control add-input-e_mail" placeholder="Email">
                                                        <p id="txt-mail">กรุณาระบุ E-Mail Address</p>

                                                    </div>
                                                    <div class="form-group form-group-phone">
                                                        <label>Phone Number</label>
                                                        <input type="email" class="form-control add-input-phone" placeholder="Phone Number">
                                                        <p id="txt-phone">กรุณาระบุ Phone Number</p>
                                                    </div>
                                                    <div class="form-group form-group-pass">
                                                        <label>Password</label>
                                                        <input type="password" class="form-control add-input-pass" placeholder="Password">
                                                        <p id="txt-pass">ต้องผสมด้วย A-Za-z0-9!@#$%^&* จำนวน 6 - 20 ตัว</p>

                                                    </div>
                                                    <div class="form-group form-group-position">
                                                        <label>position</label>
                                                        <input type="text" class="form-control add-input-position" placeholder="position" name="" id="">
                                                        <p id="txt-position">ตำแหน่งงานปัจจุบัน</p>
                                                    </div>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="checkbox-add-personal"> Agree the terms and policy
                                                        </label>
                                                    </div>
                                                    <script>
                                                        var accuracy_id_code = "";
                                                        var accuracy_name = "";
                                                        var accuracy_last_name = "";
                                                        var accuracy_e_mail = "";
                                                        var accuracy_phone = "";
                                                        var accuracy_pass = "";
                                                        var accuracy_position = "";

                                                        $('.add-input-id_code').keyup(function() {
                                                            var str = $(this).val();
                                                            if (str.length < 13 || str.length > 13) {
                                                                $('#txt-id').html('กรุณากรอกรหัสประจำตัวให้ครบ 13 หลัก');
                                                                $('.form-group-id').addClass('has-error');
                                                                accuracy_id_code = "";
                                                                return;
                                                            } else if (str.length == 13) {
                                                                var xmlhttp = new XMLHttpRequest();
                                                                // xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                                                xmlhttp.onreadystatechange = function() {
                                                                    if (this.readyState == 4 && this.status == 200) {
                                                                        //โค้ดการทำงาน
                                                                        // alert(this.responseText);
                                                                        if (this.responseText == 'success') {
                                                                            console.log(this.responseText);
                                                                            $('#txt-id').html('สามารถใช้ ID 13 หลักนี้ได้');
                                                                            $('.form-group-id').removeClass('has-error').addClass('has-success');
                                                                            accuracy_id_code = "success";
                                                                            return;
                                                                        } else if (this.responseText == 'error') {
                                                                            $('#txt-id').html('กรุณากรอกรหัสประจำตัวให้ครบ 13 หลัก');
                                                                            $('.form-group-id').addClass('has-error');
                                                                            accuracy_id_code = "";
                                                                            return;
                                                                        }
                                                                    }
                                                                }
                                                                xmlhttp.open("GET", "../controller/check_register.php?id=" + str, true);
                                                                xmlhttp.send(null);

                                                            }
                                                        });
                                                        $('.add-input-name').keyup(function() {
                                                            var str = $(this).val();
                                                            if (/^[ก-๏\s]+$/.test(str) != true && /^[a-zA-Z\s]+$/.test(str) != true && str.length != 0) {

                                                                $('#txt-name').html('กรุณากรอกชื่อตามความจริง');
                                                                $('.form-group-name').addClass('has-error');
                                                                accuracy_name = "";
                                                                return;

                                                            } else if (str.length == 0) {
                                                                $('#txt-name').html('กรุณากรอกชื่อตามความจริง');
                                                                $('.form-group-name').addClass('has-error');
                                                                accuracy_name = "";
                                                                return;
                                                            } else {
                                                                $('#txt-name').html('สามารถใช้ชื่อนี้ได้');
                                                                $('.form-group-name').removeClass('has-error').addClass('has-success');
                                                                accuracy_name = "success";
                                                                return;
                                                            }

                                                        });
                                                        $('.add-input-last_name').keyup(function() {
                                                            var str = $(this).val();
                                                            if (/^[ก-๏\s]+$/.test(str) != true && /^[a-zA-Z\s]+$/.test(str) != true && str.length != 0) {

                                                                $('#txt-last_name').html('กรุณากรอกชื่อตามความจริง');
                                                                $('.form-group-last_name').addClass('has-error');
                                                                accuracy_last_name = "";
                                                                return;

                                                            } else if (str.length == 0) {
                                                                $('#txt-last_name').html('กรุณากรอกชื่อตามความจริง');
                                                                $('.form-group-last_name').addClass('has-error');
                                                                accuracy_last_name = "";
                                                                return;
                                                            } else {
                                                                $('#txt-last_name').html('สามารถใช้นามสกุลนี้ได้');
                                                                $('.form-group-last_name').removeClass('has-error').addClass('has-success');
                                                                accuracy_last_name = "success";
                                                                return;
                                                            }
                                                        });
                                                        $('.add-input-e_mail').keyup(function() {
                                                            var str = $(this).val();
                                                            if (/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/.test(str) != true || str.length == 0) {

                                                                $('#txt-e_mail').html('ไม่สามารถใช้ E-Mail Address นี้ได้');
                                                                $('.form-group-e_mail').addClass('has-error');
                                                                accuracy_e_mail = "";
                                                                return;

                                                            } else {
                                                                // $('#txt-id').html('สามารถใช้ชื่อนี้ได้');
                                                                // $('.form-group-e_mail').removeClass('has-error').addClass('has-success');
                                                                // accuracy_e_mail = "success";
                                                                // return;

                                                                var xmlhttp = new XMLHttpRequest();

                                                                xmlhttp.onreadystatechange = function() {
                                                                    if (this.readyState == 4 && this.status == 200) {
                                                                        // alert(this.responseText);
                                                                        if (this.responseText == 'success') {
                                                                            $('#txt-e_mail').html('สามารถใช้ชื่อนี้ได้');
                                                                            $('.form-group-e_mail').removeClass('has-error').addClass('has-success');
                                                                            accuracy_e_mail = "success";
                                                                            return;
                                                                        } else if (this.responseText == 'error') {
                                                                            $('#txt-e_mail').html('ไม่สามารถใช้ E-Mail Address นี้ได้');
                                                                            $('.form-group-e_mail').addClass('has-error');
                                                                            accuracy_e_mail = "";
                                                                            return;
                                                                        }

                                                                    }
                                                                }
                                                                xmlhttp.open("GET", "../controller/check_register.php?email=" + str, true);
                                                                xmlhttp.send(null);
                                                            }

                                                        });
                                                        $('.add-input-pass').keyup(function() {
                                                            var str = $(this).val();
                                                            if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[ -/:-@\[-`{-~]).{6,64}$/.test(str) != true && str.length != 0) {
                                                                $('#txt-pass').html('ต้องผสมด้วย A-Za-z0-9!@#$%^&* จำนวน 8 - 12 ตัว');
                                                                $('.form-group-pass').addClass('has-error');
                                                                accuracy_pass = "";
                                                                return;

                                                            } else if (str.length == 0) {
                                                                $('#txt-pass').html('ต้องผสมด้วย A-Za-z0-9!@#$%^&* จำนวน 8 - 12 ตัว');
                                                                $('.form-group-pass').addClass('has-error');
                                                                accuracy_pass = "";
                                                                return;
                                                            } else {
                                                                $('#txt-pass').html('สามารถใช้ชื่อนี้ได้');
                                                                $('.form-group-pass').removeClass('has-error').addClass('has-success');
                                                                accuracy_pass = "success";
                                                                return;
                                                            }
                                                        });
                                                        $('.add-input-phone').keyup(function() {
                                                            var str = $(this).val();
                                                            if (/[0-9]{3}[0-9]{3}[0-9]{4}/.test(str) != true && str.length != 0) {
                                                                $('#txt-phone').html('กรุณากรอกมือถือที่ติดต่อได้');
                                                                $('.form-group-phone').addClass('has-error');
                                                                accuracy_phone = "";
                                                                return;

                                                            } else if (str.length < 9 || str.length > 10) {
                                                                $('#txt-phone').html('กรุณากรอกมือถือที่ติดต่อได้');
                                                                $('.form-group-phone').addClass('has-error');
                                                                accuracy_phone = "";
                                                                return;
                                                            } else {
                                                                $('#txt-phone').html('สามารถใช้เบอร์มือถือนี้ได้');
                                                                $('.form-group-phone').removeClass('has-error').addClass('has-success');
                                                                accuracy_phone = "success";
                                                                return;
                                                            }
                                                        });
                                                        $('.add-input-position').keyup(function() {
                                                            var str = $(this).val();
                                                            if (str.length <= 3) {
                                                                $('#txt-position').html('ตำแหน่งงานปัจจุบัน');
                                                                $('.form-group-position').addClass('has-error');
                                                                accuracy_position = "";
                                                                return;
                                                            } else {
                                                                $('#txt-position').html('');
                                                                $('.form-group-position').removeClass('has-error').addClass('has-success');
                                                                accuracy_position = "success";
                                                                return;
                                                            }

                                                        });
                                                    </script>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <div id="div_btn_add_person"><button type="button" class="btn btn-primary">SAVE</button></div>
                                            </div>
                                            <script>
                                                $(document).ready(function() {
                                                    $('#div_btn_add_person').hide();
                                                });
                                                $('.checkbox-add-personal').click(function() {
                                                    if ($('.checkbox-add-personal').prop('checked') == true) {
                                                        // alert('Please');
                                                        $('#div_btn_add_person').show();
                                                    } else {
                                                        $('#div_btn_add_person').hide();

                                                        // alert('Error');
                                                    }
                                                });
                                                $('#div_btn_add_person').click(function() {
                                                    // alert('Success');
                                                    var id_code = $('.add-input-id_code').val();
                                                    var name = $('.add-input-name').val();
                                                    var last_name = $('.add-input-last_name').val();
                                                    var e_mail = $('.add-input-e_mail').val();
                                                    var pass = $('.add-input-pass').val();
                                                    var phone = $('.add-input-phone').val();
                                                    var position = $('.add-input-position').val();



                                                    if (
                                                        accuracy_id_code == "success" &&
                                                        accuracy_name == "success" &&
                                                        accuracy_last_name == "success" &&
                                                        accuracy_e_mail == "success" &&
                                                        accuracy_pass == "success" &&
                                                        accuracy_phone == "success" &&
                                                        accuracy_position == "success"
                                                    ) {
                                                        swal({
                                                            title: "Are you sure?",
                                                            text: "Once deleted, you will not be able to recover this imaginary file!",
                                                            icon: "warning",
                                                            buttons: true,
                                                            dangerMode: true,

                                                        }).then((willDelete) => {
                                                            if (willDelete) {
                                                                $.ajax({
                                                                    type: "POST",
                                                                    data: {
                                                                        key: 'submit-registers',
                                                                        cid: id_code,
                                                                        uname: name,
                                                                        lastname: last_name,
                                                                        phone: phone,
                                                                        email: e_mail,
                                                                        pass: pass,
                                                                        position: position
                                                                    },
                                                                    url: "../controller/inser_register.php",
                                                                    success: function(result, textStatus, jqXHR) {
                                                                        // alert(result);
                                                                        // swal("Hey, i will close in 2 seconds !!", {
                                                                        //     icon: "success",
                                                                        //     buttons: false,
                                                                        //     timer: 2000,
                                                                        // });
                                                                        if (result == 'success') {

                                                                            $('.add-input-id_code').val('');
                                                                            $('.add-input-name').val('');
                                                                            $('.add-input-last_name').val('');
                                                                            $('.add-input-e_mail').val('');
                                                                            $('.add-input-pass').val('');
                                                                            $('.add-input-phone').val('');
                                                                            $('.add-input-position').val('');

                                                                            accuracy_id_code = "";
                                                                            accuracy_name = "";
                                                                            accuracy_last_name = "";
                                                                            accuracy_e_mail = "";
                                                                            accuracy_pass = "";
                                                                            accuracy_phone = "";
                                                                            accuracy_position = "";

                                                                            $('#txt-id').html('');
                                                                            $('.form-group-id').removeClass('has-success');

                                                                            $('#txt-phone').html('');
                                                                            $('.form-group-phone').removeClass('has-success');

                                                                            $('#txt-name').html('');
                                                                            $('.form-group-name').removeClass('has-success');

                                                                            $('#txt-last_name').html('');
                                                                            $('.form-group-last_name').removeClass('has-success');

                                                                            $('#txt-e_mail').html('');
                                                                            $('.form-group-e_mail').removeClass('has-success');

                                                                            $('#txt-pass').html('');
                                                                            $('.form-group-pass').removeClass('has-success');

                                                                            $('#txt-position').html('');
                                                                            $('.form-group-position').removeClass('has-success');


                                                                            // $("#div_btn_add_person").attr('data-dismiss', 'modal');

                                                                            swal("เพิ่มบุคคลากรสำเร็จ", {
                                                                                icon: "success",
                                                                                buttons: false,
                                                                                timer: 1000,
                                                                            });
                                                                            show_tb_mg_personal();

                                                                        } else {
                                                                            swal("", "ตรวจสอบข้อมูลอีกครั้ง!", "info");

                                                                        }


                                                                    },
                                                                    error: function(jqXHR, textStatus, errorTh) {
                                                                        // alert(errorTh + ": " + textStatus + " " + jqXHR.text)
                                                                        swal("", "เกินข้อผิดพลาด!", "error");

                                                                    }
                                                                });

                                                            } else {
                                                                swal("Your imaginary file is safe!");
                                                            }
                                                        });
                                                    } else {
                                                        swal("", "ตรวจสอบข้อมูลอีกครั้ง!", "info");
                                                    }

                                                });

                                                function sleep(ms) {
                                                    return new Promise(resolve => setTimeout(resolve, ms));
                                                }

                                                async function timemer() {
                                                    swal("Hey, i will close in 2 seconds !!", {
                                                        icon: "success",
                                                        buttons: false,
                                                        timer: 1000,
                                                    });
                                                    // swal("SUCCESS", "อัพเดตข้อมูลสำร็จ!", "success", {
                                                    //     buttons: false
                                                    // });
                                                    await sleep(1500);
                                                    // history.back(1);
                                                    // location.reload();
                                                    show_tb_mg_personal();
                                                }
                                            </script>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </section>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer">
                            <p>2018 © Admin Board. - <a href="#">example.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- scripit init-->
    <!-- <script src="../../script/assets/js/lib/data-table/datatables.min.js"></script> -->



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

</body>

<!-- 
                                <div class="modal fade" id="edit_personal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลส่วนตัว</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label>รหัสประจำตัว</label>
                                                        <input type="text" class="form-control" value="1339900662225" placeholder="รหัสประจำตัว">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>User Name</label>
                                                        <input type="text" class="form-control" value="นายสมพล" placeholder="User Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="email" class="form-control" value="วิลา" placeholder="Last Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email address</label>
                                                        <input type="email" class="form-control" value="std.62122710108@ubru.ac.th" placeholder="Email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" class="form-control" value="12345678" placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>position</label>

                                                        <select class="form-control">
                                                            <option></option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option <?php //echo "x" == 'x' ? "selected" : '' 
                                                                    ?>>3</option>
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
                                                <button type="button" class="btn btn-danger" onclick="window.confirm('ยืนยันการลบบุคลากรถาวร!!')">Delete</button>
                                                <button type="button" class="btn btn-primary">SAVE</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
-->

</html>