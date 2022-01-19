<!DOCTYPE html>
<html lang="en">
<?php
// session_start();
include_once("./sidebar_ad.php");



?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จัดการผู้ดูแลระบบ</title>

</head>
<script>
    const ID_ADMIN = '<?php echo $id_admin; ?>';
    var str_pass = '';

    $(document).ready(function() {
        show_admin_info();

    });



    function show_admin_info() {
        $.ajax({
            url: './controller/con_mg_admin.php',
            type: 'POST',
            data: {
                key: 'show_admin_info'
            },
            success: function(result, textStatus, jqXHR) {
                // alert(result + ': ' + textStatus);
                var json = JSON.parse(result);

                str_pass = json[0].pass_ad;
                var str = "";
                for (index in str_pass) {
                    str += '*';
                }
                $('.tl_name').html(json[0].name_ad);
                $('.ad_name').html(json[0].name_ad);
                $('.ad_e_mail').html(json[0].e_emil_ad);
                $('.ad_pass').html(str);

                $('.input-name-ad').val(json[0].name_ad);
                $('.input-email-ad').val(json[0].e_emil_ad);
                $('.input-new-pass-ad').val(json[0].pass_ad);
                $('.input-confrime-pass-ad').val('');

            },
            error: function(result, textStatus, jqX) {
                history.back(1);
            }
        });
    }
</script>

<body>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">

                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./dashboard_ad.php">หน้าหลัก</a></li>
                                    <li class="breadcrumb-item active">จัดการผู้ดูแลระบบ</li>
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
                                                <div class="user-profile-name tl_name">สมพล วิลา</div>
                                                <div class="user-job-title ">ผู้ดูแลระบบ</div>
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
                                                                <div class="address-content">
                                                                    <span class="contact-title">ชื่อ:</span>
                                                                    <span class="contact-skype ad_name">สมพล</span>
                                                                </div>
                                                                <div class="email-content">
                                                                    <span class="contact-title">Email:</span>
                                                                    <span class="contact-email ad_e_mail"></span>
                                                                </div>
                                                                <div class="phone-content">
                                                                    <span class="contact-title">รหัสผ่าน:</span>
                                                                    <!-- <a id="click-show" class="user-job-title1" href="#" onclick="show()" >*******</a> -->
                                                                    <span class="contact-email ad_pass" id="show-pass"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="user-send-message">
                                                        <button class="btn btn-sm btn-warning btn-rounded edit-admin-btn" type="button" data-toggle="modal" data-target="#edit">
                                                            <i class="ti-hummer"></i>&nbsp;&nbsp;แก้ไข</button>
                                                        <script>
                                                            //     $('.edit-admin-btn').click(function(){
                                                            //         confrime("slkdfjsdf");
                                                            //     });
                                                            // 
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
                                                                            <label>ชื่อผู้ดูแลระบบ</label>
                                                                            <input type="text" class="form-control input-name-ad" placeholder="ชื่อผู้ดูแลระบบ">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>อีเมล</label>
                                                                            <input type="email" class="form-control input-email-ad" placeholder="Email">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>รหัสผ่านใหม่</label>
                                                                            <input type="password" class="form-control input-new-pass-ad" placeholder="New Password">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>รหัสผ่านปัจจุบัน</label>
                                                                            <input type="password" class="form-control input-confrime-pass-ad" placeholder="Password">
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input class="input-checkbox" type="checkbox"> ยอมรับการเปลี่ยนแปลงโปรดจำรหัสผ่าน
                                                                            </label>
                                                                            <script>
                                                                                $(document).ready(function() {
                                                                                    $('#div-btn-edit-ad').hide();
                                                                                });
                                                                                $('.input-checkbox').click(function() {
                                                                                    if ($('.input-checkbox').prop('checked') == true) {
                                                                                        // alert('OK');
                                                                                        $('#div-btn-edit-ad').show();
                                                                                    } else {
                                                                                        $('#div-btn-edit-ad').hide();
                                                                                    }
                                                                                });
                                                                            </script>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                                                    <div id='div-btn-edit-ad'> <button id='btn-edit-save' type="button" class="btn btn-primary">บันทึกการแก้ไข</button> </div>
                                                                    <script>
                                                                        $('#btn-edit-save').click(function() {
                                                                            // alert('ckick');
                                                                            if (confirm('คุณแน่ใจหรือว่าต้องการแก้ไข?')) {
                                                                                // alert($('.input-confrime-pass-ad').val() + ' ' + str_pass);
                                                                                if ($('.input-confrime-pass-ad').val() == str_pass) {
                                                                                    $.ajax({
                                                                                        url: './controller/con_mg_admin.php',
                                                                                        type: 'POST',
                                                                                        data: {
                                                                                            key: 'btn-edit-save',
                                                                                            id_admin: ID_ADMIN,
                                                                                            name_ad: $('.input-name-ad').val(),
                                                                                            pass_ad: $('.input-new-pass-ad').val(),
                                                                                            e_emil_ad: $('.input-email-ad').val()

                                                                                        },
                                                                                        success: function(result, textStatus, jqx) {
                                                                                            swal("SUCCESS", "แก้ไขสำเร็จ", 'success', {
                                                                                                button: false,
                                                                                                timer: 1000
                                                                                            });

                                                                                            show_admin_info();


                                                                                            // alert(result);
                                                                                            // $("#edit").hide();
                                                                                        },
                                                                                        error: function(jqxhr, textStatus, errorThrown) {

                                                                                        }
                                                                                    });
                                                                                } else {
                                                                                    swal("Please", "รหัสผ่านปัจจุบัน", 'warning', {
                                                                                        button: false,
                                                                                        timer: 1000
                                                                                    });
                                                                                }
                                                                            }

                                                                        });
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
</body>

</html>