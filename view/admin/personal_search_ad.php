<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar_ad.php");

if (isset($_GET['id'])) :
    $id_mem = $_GET['id'];
    $search_mem = Database::query("SELECT * FROM members WHERE id_mem = '{$id_mem}'", PDO::FETCH_ASSOC);
    $row = $search_mem->fetch();

?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title class="name"></title>
        <!-- Styles -->
        <!-- <link href="../../script/assets/css/lib/sweetalert/sweetalert.css" rel="stylesheet"> -->

        <link href="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    </head>

    <body>
        <script>
            const ID_MEM = '<?php echo $id_mem; ?>';
            var id_code = '';
            window.onload = function() {
                information_person_info();
            }


            var accuracy_name = "success";
            var accuracy_lastname = "success";
            var accuracy_mail = "success";
            var accuracy_phone = "success";
            var accuracy_pass = "success";
            var accuracy_position = "success";

            var password = "";

            function send_post_get(path, params, method) {
                const form = document.createElement('form');
                form.method = method;
                form.action = path;

                for (const key in params) {
                    if (params.hasOwnProperty(key)) {
                        const hiddenField = document.createElement('input');
                        hiddenField.type = 'hidden';
                        hiddenField.name = key;
                        hiddenField.value = params[key];

                        form.appendChild(hiddenField);
                    }
                }

                document.body.appendChild(form);
                form.submit();
            }

            function information_person_info() {

                // var id_code = document.getElementById("id_code");
                // var name = document.getElementById("name");
                // var last_name = document.getElementById("last_name");
                // var e_mail = document.getElementById("e_mail");
                // var phone = document.getElementById("phone");
                // var position = document.getElementById("position");
                // var full_name = document.getElementById("full_name");


                // //  Input - Edit 
                // var input_name = document.getElementById('input-name');
                // var input_last_name = document.getElementById('input-lastn_name');
                // var input_email = document.getElementById('input-email');
                // var input_phone = document.getElementById('input-phone');
                // var input_pass = document.getElementById('input-pass');
                // var input_position = document.getElementById('input-position');

                $.ajax({
                    type: "POST",
                    url: "./controller/con_per_search.php",
                    data: {
                        key: "information_person_info",
                        id_mem: ID_MEM

                    },
                    success: function(result, textStatus, jqXHR) {
                        // alert(result);
                        // console.log(result);
                        var json = JSON.parse(result);
                        if (json != false) {


                            id_code = json[0].id_code;
                            $('.user-profile-name').html(json[0].name + ' ' + json[0].last_name);
                            $('.user-job-title').html(json[0].position);

                            $('.id_code').html(json[0].id_code);
                            $('.name').html(json[0].name);
                            $('.last_name').html(json[0].last_name);
                            $('.e_mail').html(json[0].e_mail);
                            $('.phone').html(json[0].phone);
                            $('.position').html(json[0].position);


                            $('.input-name').val(json[0].name);
                            $('.input-last_name').val(json[0].last_name);
                            $('.input-e_mail').val(json[0].e_mail);
                            $('.input-phone').val(json[0].phone);
                            $('.input-position').val(json[0].position);
                            $('.input-pass').val(json[0].pass);


                            //     // แสดงปุ๋มสถานะการอัพโหลดภาพใบหน้า ?
                            if (json[0].stu_face == "0") {

                                $(".div-btn-show-image").hide();
                                $('.div-btn-upload-image').show();
                                $('.backup-image').hide();

                            } else {

                                $(".div-btn-show-image").show();
                                $('.div-btn-upload-image').hide();
                                $('.backup-image').show();

                            }

                        } else {
                            alert("แจ้งเตือนข้อผิดพลาดไม่สามารถแสดงข้อมูลได้")
                            history.back(1);
                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // location.assign("../error/error-404.html");
                        alert("Error: " + errorThrown);
                    }
                });
            }
        </script>
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
                                        <li class="breadcrumb-item active">บุคลากร</li>

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
                                                    <div class="user-profile-name"></div>

                                                    <div class="user-job-title"></div>

                                                    <div class="row">
                                                        <div class="user-send-message div-btn-show-image">
                                                            <button id="click-show-image" class="btn btn-sm  btn-success btn-rounded" type="button">
                                                                <i class="ti-zoom-in"></i>&nbsp;&nbsp;ตรวจสอบภาพ</button>
                                                            <script>
                                                                $('#click-show-image').click(function() {
                                                                    // alert('click-show-image');
                                                                    send_post_get('./image_search_ad.php', {
                                                                        id: ID_MEM
                                                                    }, 'get');

                                                                });
                                                                // onclick="window.location.assign'./image_search_ad.php' ;
                                                            </script>
                                                        </div>
                                                        <div class="user-send-message div-btn-upload-image">
                                                            <button id="upload_image" class="btn btn-danger btn-rounded" type="button">
                                                                <i class="ti-cloud-up"></i>&nbsp;&nbsp;สถานะไม่สมบูรณ์</button>
                                                            <script>
                                                                $('#upload_image').click(function() {
                                                                    // alert('Upload');
                                                                    send_post_get('./on_save_face.php', {
                                                                        id: ID_MEM
                                                                    }, 'get');
                                                                });

                                                                // onclick='window.location.assign("./on_save_face.php");'
                                                            </script>
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
                                                                        <span class="contact-title">รหัสประจำตัว:</span>
                                                                        <span class="contact-skype id_code"></span>
                                                                    </div>
                                                                    <div class="address-content">
                                                                        <span class="contact-title">ชื่อ:</span>
                                                                        <span class="contact-skype name"></span>
                                                                    </div>
                                                                    <div class="email-content">
                                                                        <span class="contact-title">นามสกุล:</span>
                                                                        <span class="contact-email last_name"></span>
                                                                    </div>
                                                                    <div class="email-content">
                                                                        <span class="contact-title">Email:</span>
                                                                        <span class="contact-email e_mail"></span>
                                                                    </div>
                                                                    <div class="phone-content">
                                                                        <span class="contact-title">Phone:</span>
                                                                        <span class="phone-number phone"></span>
                                                                    </div>
                                                                    <div class="phone-content">
                                                                        <span class="contact-title">Position:</span>
                                                                        <span class="contact-skype position"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="user-send-message backup-image">
                                                            <button id='click_backup_image' class="btn btn-info btn-rounded btn-sm" type="button">
                                                                <i class="ti-cloud-down"></i>&nbsp;&nbsp;สำรองข้อมูลภาพ</button>
                                                            <script>
                                                                $('#click_backup_image').click(function() {
                                                                    send_post_get('./controller/con_image_search_ad.php', {
                                                                        key: "backup_img_person",
                                                                        id_mem: ID_MEM,
                                                                    }, 'POST');
                                                                });
                                                            </script>
                                                        </div>
                                                        <div class="user-send-message">
                                                            <button class="btn btn-sm btn-warning btn-rounded" type="button" data-toggle="modal" data-target="#edit">
                                                                <i class="ti-hummer"></i>&nbsp;&nbsp;แก้ไข</button>
                                                        </div>
                                                        <div class="user-send-message">
                                                            <button id="delete_person" class="btn btn-danger btn-rounded btn-sm  sweet-confirm btn btn-success btn sweet-success btn btn-primary btn sweet-text btn btn-info btn sweet-message btn btn-danger btn sweet-wrong" type="button">
                                                                <i class="ti-alert"></i>&nbsp;&nbsp;ลบบุคลากร</button>

                                                            <script>
                                                                $('#delete_person').click(function() {
                                                                    if (confirm('Are you sure you want to delete!')) {
                                                                        $.ajax({
                                                                            url: "./controller/con_per_search.php",
                                                                            type: "POST",
                                                                            data: {
                                                                                key: "delete_person",
                                                                                id_mem: ID_MEM
                                                                            },
                                                                            success: function(result, textStatus, jqXHR) {
                                                                                // alert(result);
                                                                                if (result == 'success') {
                                                                                    timemer_delete();
                                                                                }
                                                                            },
                                                                            error: function(jqXHR, textStatus, errorThrown) {
                                                                                alert("เกิดข้อผิดพลาดขึ้น");
                                                                            }
                                                                        });
                                                                    }

                                                                });
                                                                async function timemer_delete() {
                                                                    swal("ลบข้อมูลสำร็จ", "ระบบจะพาท่านกลับไปยังหน้าก่อนหน้านี้ ประมาณ 2 วินาที", {
                                                                        icon: "success",
                                                                        buttons: false,
                                                                        timer: 1500,
                                                                    });
                                                                    // swal("SUCCESS", "อัพเดตข้อมูลสำร็จ!", "success", {
                                                                    //     buttons: false
                                                                    // });
                                                                    await sleep(2000);
                                                                    // location.reload();
                                                                    history.back(1);
                                                                }
                                                            </script>
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
                                                                                <label>ชื่อ</label>
                                                                                <input type="text" class="form-control input-name" placeholder="ชื่อ">
                                                                                <p id="txt-name"></p>
                                                                                <script>
                                                                                    $(".input-name").on("keyup", function() {
                                                                                        var str = $(this).val();
                                                                                        accuracy_name = "success";
                                                                                        if (/^[ก-๏\s]+$/.test(str) != true && /^[a-zA-Z\s]+$/.test(str) != true && str.length != 0) {
                                                                                            $('#txt-name').html("กรุณากรอกชื่อตามความจริง");
                                                                                            document.getElementById('div-name').className = 'form-group has-error';
                                                                                            accuracy_name = "";
                                                                                            return;
                                                                                        }
                                                                                        if (str.length == 0) {
                                                                                            $('#txt-name').html("กรุณากรอกชื่อตามความจริง");
                                                                                            document.getElementById('div-name').className = 'form-group ';
                                                                                            accuracy_name = "";
                                                                                            return;
                                                                                        } else {
                                                                                            $('#txt-name').html("สามารถใช้ชื่อนี้ได้");
                                                                                            document.getElementById('div-name').className = 'form-group has-success';
                                                                                            accuracy_name = "success";
                                                                                            return;
                                                                                        }
                                                                                    });
                                                                                </script>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>นามสกุล</label>
                                                                                <input type="email" class="form-control input-last_name" placeholder="นามสกุล">
                                                                                <p id="txt-lastname"></p>
                                                                                <script>
                                                                                    $(".input-last_name").on("keyup", function() {
                                                                                        accuracy_lastname = "success";
                                                                                        var str = $(this).val();
                                                                                        if (/^[ก-๏\s]+$/.test(str) != true && /^[a-zA-Z\s]+$/.test(str) != true && str.length != 0) {
                                                                                            document.getElementById("txt-lastname").innerHTML = "กรุณากรอกนามสกุลตามความจริง";
                                                                                            // document.getElementById('div-lastname').className = 'form-group has-error';
                                                                                            accuracy_lastname = "";
                                                                                            return;
                                                                                        }
                                                                                        if (str.length == 0) {
                                                                                            document.getElementById("txt-lastname").innerHTML = "กรุณากรอกนามสกุลตามความจริง";
                                                                                            // document.getElementById('div-lastname').className = 'form-group ';
                                                                                            accuracy_lastname = "";
                                                                                            return;
                                                                                        } else {
                                                                                            document.getElementById("txt-lastname").innerHTML = "สามารถใช้นามสกุลนี้ได้";
                                                                                            // document.getElementById('div-lastname').className = 'form-group has-success';
                                                                                            accuracy_lastname = "success";
                                                                                            return;
                                                                                        }
                                                                                    });
                                                                                </script>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>อีเมล</label>
                                                                                <input type="email" class="form-control input-e_mail" placeholder="อีเมล">
                                                                                <p id="txt-mail"></p>
                                                                                <script>
                                                                                    $(".input-e_mail").on("keyup", function() {
                                                                                        var str = $(this).val();
                                                                                        // alert("Email");
                                                                                        accuracy_mail = "success";
                                                                                        // alert(str);
                                                                                        if (/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}/.test(str) != true && str.length != 0) {
                                                                                            // document.getElementById('div-mail').className = 'form-group has-error';
                                                                                            document.getElementById("txt-mail").innerHTML = "ไม่สามารถใช้ E-Mail Address นี้ได้";
                                                                                            accuracy_mail = "";
                                                                                            return;
                                                                                        }
                                                                                        if (str.length == 0) {
                                                                                            // document.getElementById('div-mail').className = 'form-group';
                                                                                            document.getElementById("txt-mail").innerHTML = "ไม่สามารถใช้ E-Mail Address นี้ได้";
                                                                                            accuracy_mail = "";
                                                                                            return;
                                                                                        } else {
                                                                                            // document.getElementById('div-mail').className = 'form-group has-success';
                                                                                            document.getElementById("txt-mail").innerHTML = "สามารถใช้ E-Mail นี้ได้";
                                                                                            accuracy_mail = "success";
                                                                                            return;
                                                                                        }
                                                                                    });
                                                                                </script>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>เบอร์ติดต่อ</label>
                                                                                <input type="text" class="form-control input-phone" placeholder="เบอร์ติดต่อ">
                                                                                <p id="txt-phone"></p>
                                                                                <script>
                                                                                    $(".input-phone").on("keyup", function() {
                                                                                        accuracy_phone = "success";
                                                                                        var str = $(this).val();
                                                                                        // alert(str['0']);
                                                                                        if (/[0-9]{3}[0-9]{3}[0-9]{4}/.test(str) != true && str.length != 0) {
                                                                                            document.getElementById("txt-phone").innerHTML = "กรุณากรอกมือถือที่ติดต่อได้";
                                                                                            accuracy_phone = "";
                                                                                            return;
                                                                                        } else if (str.length == 0) {
                                                                                            document.getElementById("txt-phone").innerHTML = "กรุณากรอกมือถือที่ติดต่อได้";
                                                                                            accuracy_phone = "";
                                                                                            return;
                                                                                        } else if (str.length > 10) {
                                                                                            document.getElementById("txt-phone").innerHTML = "กรุณากรอกมือถือที่ติดต่อได้";
                                                                                            accuracy_phone = "";
                                                                                        } else if (str['0'] != '0' || str['1'] != '9' || str['1'] != '8' || str['1'] != '6') {
                                                                                            alert("Please enter");
                                                                                            document.getElementById("txt-phone").innerHTML = "กรุณากรอกมือถือที่ติดต่อได้";
                                                                                            accuracy_phone = "";
                                                                                        } else {
                                                                                            document.getElementById("txt-phone").innerHTML = "สามารถใช้เบอร์มือถือนี้ได้";
                                                                                            accuracy_phone = "success";
                                                                                            return;
                                                                                        }
                                                                                    });
                                                                                </script>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>รหัสผ่าน</label>
                                                                                <input type="text" class="form-control input-pass" placeholder="รหัสผ่าน">
                                                                                <p id="txt-pass"></p>
                                                                                <script>
                                                                                    $(".input-pass").on("keyup", function() {
                                                                                        // alert("chel");
                                                                                        accuracy_pass = "success";
                                                                                        var str = $(this).val();
                                                                                        if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[ -/:-@\[-`{-~]).{6,64}$/.test(str) != true && str.length != 0) {
                                                                                            document.getElementById("txt-pass").innerHTML = "ต้องผสมด้วย A-Za-z0-9!@#$%^&* จำนวน 8 - 12 ตัว";
                                                                                            // document.getElementById('div-pass').className = 'form-group has-error';
                                                                                            accuracy_pass = "";
                                                                                            return;
                                                                                        } else if (str.length == 0) {
                                                                                            document.getElementById("txt-pass").innerHTML = "ต้องผสมด้วย A-Za-z0-9!@#$%^&* จำนวน 8 - 12 ตัว";
                                                                                            // document.getElementById('div-pass').className = 'form-group ';
                                                                                            accuracy_pass = "";
                                                                                            return;
                                                                                        } else {
                                                                                            document.getElementById("txt-pass").innerHTML = "สามารถใช้รหัสผ่านนี้ได้";
                                                                                            // document.getElementById('div-pass').className = 'form-group has-success';
                                                                                            accuracy_pass = "success";
                                                                                            return;
                                                                                        }
                                                                                    });
                                                                                </script>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>ตำแหน่งงาน</label>
                                                                                <input type="text" class="form-control input-position" placeholder="ตำแหน่งงาน">
                                                                                <p id="txt-position">ตำแหน่งงานปัจจุบัน</p>
                                                                                <script>
                                                                                    $(".input-position").on("keyup", function() {
                                                                                        var str = $(this).val();
                                                                                        accuracy_position = "success";
                                                                                        if (str.length <= 2) {
                                                                                            document.getElementById("txt-position").innerHTML = "ตำแหน่งงานปัจจุบัน";
                                                                                            accuracy_position = "";
                                                                                            return;
                                                                                        } else {
                                                                                            document.getElementById("txt-position").innerHTML = "";
                                                                                            accuracy_position = "success";
                                                                                            return;
                                                                                        }
                                                                                    });
                                                                                </script>
                                                                            </div>
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input id="check-box_ok" type="checkbox"> ยืนการแก้ไขข้อมูล
                                                                                </label>
                                                                                <script>
                                                                                    $(document).ready(function() {
                                                                                        $('#mod_save').hide();

                                                                                    });
                                                                                    $('#check-box_ok').click(function() {
                                                                                        if ($('#check-box_ok').prop('checked') == true) {
                                                                                            // alert('OK');
                                                                                            $('#mod_save').show();
                                                                                        } else {
                                                                                            $('#mod_save').hide();

                                                                                            // alert('Error');
                                                                                        }
                                                                                    });
                                                                                </script>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <div id="mod_save"><button id="btn_edit_submit" type="button" class="btn btn-primary btn-submit">SAVE</button></div>
                                                                        <script>
                                                                            $('#mod_save').click(function() {
                                                                                $('.input-name').val();
                                                                                $('.input-last_name').val();
                                                                                $('.input-e_mail').val();
                                                                                $('.input-phone').val();
                                                                                $('.input-position').val();
                                                                                $('.input-pass').val();

                                                                                // alert($('.input-position').val());
                                                                                // information_person_info();
                                                                                // $('#mod_save').attr("data-dismiss", "modal");
                                                                                if (
                                                                                    accuracy_name == "success" &&
                                                                                    accuracy_lastname == "success" &&
                                                                                    accuracy_mail == "success" &&
                                                                                    accuracy_pass == "success" &&
                                                                                    accuracy_phone == "success" &&
                                                                                    accuracy_position == "success"
                                                                                ) {

                                                                                    if (confirm("คุณต้องการแก้ไขข้อมูลบุคลากร?")) {
                                                                                        $.ajax({
                                                                                            type: "POST",
                                                                                            url: "./controller/con_per_search.php",
                                                                                            data: {
                                                                                                key: "btn_edit_save_person",
                                                                                                id_mem: ID_MEM,
                                                                                                name: $('.input-name').val(),
                                                                                                last_name: $('.input-last_name').val(),
                                                                                                e_mail: $('.input-e_mail').val(),
                                                                                                phone: $('.input-phone').val(),
                                                                                                pass: $('.input-pass').val(),
                                                                                                position: $('.input-position').val()
                                                                                            },
                                                                                            success: function(result, textStatus, jqXHR) {
                                                                                                // alert(result);
                                                                                                if (result == "success") {
                                                                                                    // swal("SUCCESS", "อัพเดตข้อมูลสำร็จ!", "success");
                                                                                                    // swal("เพิ่ม Permission สำเร็จ", {
                                                                                                    //     icon: "success",
                                                                                                    //     buttons: false,
                                                                                                    //     timer: 1000,
                                                                                                    // });
                                                                                                    timemer();

                                                                                                    // $('#edit').modal('hide');
                                                                                                    // $('#mod_save').attr("data-dismiss", "modal");
                                                                                                } else {
                                                                                                    swal("Error", "ไม่สามารถอัพเดตข้อมูลได้!", "error");
                                                                                                    // $('#mod_save').attr("data-dismiss", "modal");

                                                                                                }
                                                                                            },
                                                                                            error: function(jqXHR, textStatus, errorThrown) {
                                                                                                // alert(jqXHR.status);
                                                                                                swal("Error", "เกิดข้อผลิดพลาดไม่สามารถเชื่อมต่อเซิฟเวอร์ได้", "error");
                                                                                                // $('#edit').modal('hide');
                                                                                            }
                                                                                        });
                                                                                    }


                                                                                } else {

                                                                                    swal("", "ตรวจสอบข้อมูลอีกครั้ง!", "info");

                                                                                    // swal("", "ตรวจสอบข้อมูลอีกครั้ง!", "info");
                                                                                }
                                                                            });

                                                                            function sleep(ms) {
                                                                                return new Promise(resolve => setTimeout(resolve, ms));
                                                                            }

                                                                            async function timemer() {
                                                                                swal("อัพเดตข้อมูลสำร็จ", {
                                                                                    icon: "success",
                                                                                    buttons: false,
                                                                                    timer: 1500,
                                                                                });
                                                                                // swal("SUCCESS", "อัพเดตข้อมูลสำร็จ!", "success", {
                                                                                //     buttons: false
                                                                                // });
                                                                                await sleep(2000);
                                                                                location.reload();
                                                                            }
                                                                        </script>
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
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-title">
                                        <h4>รายชื่อห้องที่มีสิทธิ์เข้า</h4>

                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="table_el" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>ลำดับ</th>
                                                        <th>ห้อง</th>
                                                        <th class="text-center">ตรวจสอบ </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbb_el">
                                                </tbody>
                                            </table>
                                            <script>
                                                $(document).ready(function() {
                                                    table_el();
                                                });

                                                function table_el() {
                                                    var table_el = $('#table_el').DataTable({
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

                                                        // sInfoEmpty: "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                                                        processing: true, // แสดงข้อความกำลังดำเนินการ กรณีข้อมูลมีมากๆ จะสังเกตเห็นง่าย
                                                        //serverSide: true, // ใช้งานในโหมด Server-side processing
                                                        order: [], // กำหนดให้ไม่ต้องการส่งการเรียงข้อมูลค่าเริ่มต้น จะใช้ค่าเริ่มต้นตามค่าที่กำหนดในไฟล์ php
                                                        ajax: {

                                                        },

                                                        buttons: [{
                                                            extend: 'excel',
                                                            text: 'ส่งออก EXCEL',
                                                            messageTop: 'Cybernetics Corp.',
                                                            filename: function() {
                                                                // const d = new Date();
                                                                // // let time = d.getTime();
                                                                // let hour = d.getHours();
                                                                // let minutes = d.getMinutes();
                                                                // let day = d.getDay();
                                                                // let month = d.getMonth();
                                                                // let year = d.getFullYear();
                                                                return "รายชื่อห้องที่มีสิทธิ์เข้าของ" + id_code; //+hour+'-'+minutes + '-'+days +'-'+month +'-'+years
                                                            },
                                                            // title: 'รายชื่อสิทเข้าห้อง',
                                                            exportOptions: {
                                                                columns: [0, 1],
                                                                // คอลัมส์ที่จะส่งออก
                                                                // modifier: {
                                                                //     page: 'all' // หน้าที่จะส่งออก all / current
                                                                // },
                                                                // stripHtml: true
                                                            }
                                                        }],
                                                        retrieve: true,

                                                    });

                                                    table_el.clear();
                                                    $.ajax({
                                                        url: "./controller/con_per_search.php",
                                                        type: "POST",
                                                        data: {
                                                            key: 'table_el',
                                                            id_mem: ID_MEM
                                                        },
                                                        success: function(result, textStatus, jqXHR) {
                                                            // alert(result);

                                                            var json = JSON.parse(result);

                                                            var count = 1;
                                                            $.each(json, function(key, val) {

                                                                var col1 = count++;
                                                                var col2 = val['room_num'];
                                                                var col3 = '<div class="text-center"> <a href="./room_search_ad.php?id=' + val['id_room'] + '"class="click_submit_search_clode"><i class="ti-search"></i></a> </div>';


                                                                table_el.row.add([
                                                                    col1, col2, col3
                                                                ]).draw(true);

                                                            });
                                                        },
                                                        error: function(jqXHR, textStatus, errorThrown) {

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
                        <!-- /# row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-title">
                                        <h4>ประวัติการใช้งานห้อง</h4>

                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="bootstrap-data-table-export" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>ลำดับ</th>
                                                        <th>ห้อง</th>
                                                        <th>เวลา &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbb_el">
                                                    <?php
                                                    $co = 1;
                                                    foreach ($src = Database::query("SELECT * FROM `schedule` as sc  WHERE sc.id_mem = '$id_mem';") as $row) :

                                                    ?>
                                                        <tr>
                                                            <td><?php echo $co ?></td>
                                                            <td><?php echo $row['room_name'] ?></td>
                                                            <td><?php echo $row['time_stamp'] ?></td>
                                                        </tr>
                                                    <?php
                                                        $co++;
                                                    endforeach;
                                                    ?>
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
                                <div class="footer">
                                    <p>2022 © ITT Software.</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <!-- <script src="../../script/assets/js/lib/sweetalert/sweetalert.min.js"></script> -->
        <!-- <script src="../../script/assets/js/lib/sweetalert/sweetalert.init.js"></script> -->




        <script>
            $(document).ready(function() {
                // $('#bootstrap-data-table-export').DataTable();
                $('#bootstrap-data-table-export').DataTable({
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

                    // sInfoEmpty: "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                    processing: true, // แสดงข้อความกำลังดำเนินการ กรณีข้อมูลมีมากๆ จะสังเกตเห็นง่าย
                    //serverSide: true, // ใช้งานในโหมด Server-side processing
                    order: [], // กำหนดให้ไม่ต้องการส่งการเรียงข้อมูลค่าเริ่มต้น จะใช้ค่าเริ่มต้นตามค่าที่กำหนดในไฟล์ php
                    ajax: {

                    },

                    buttons: [{
                        extend: 'excel',
                        text: 'ส่งออก EXCEL',
                        messageTop: 'Cybernetics Corp.',
                        filename: function() {
                            // const d = new Date();
                            // // let time = d.getTime();
                            // let hour = d.getHours();
                            // let minutes = d.getMinutes();
                            // let day = d.getDay();
                            // let month = d.getMonth();
                            // let year = d.getFullYear();
                            return "ประวัติการใช้งานห้องของ" + id_code; //+hour+'-'+minutes + '-'+days +'-'+month +'-'+years
                        },
                        // title: 'รายชื่อสิทเข้าห้อง',
                        exportOptions: {
                            columns: [0, 1],
                            // คอลัมส์ที่จะส่งออก
                            // modifier: {
                            //     page: 'all' // หน้าที่จะส่งออก all / current
                            // },
                            // stripHtml: true
                        }
                    }],
                    retrieve: true,

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
        <!-- <script src="../../script/assets/js/lib/data-table/datatables-init.js"></script> -->
    </body>
<?php
endif;
?>

</html>