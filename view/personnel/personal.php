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
    <!-- Styles -->
    <link href="../../script/assets/css/lib/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


</head>
<script>
    var accuracy_name = "";
    var accuracy_lastname = "";
    var accuracy_mail = "";
    var accuracy_phone = "";
    var accuracy_pass = "";
    var accuracy_position = "";

    var password = "";

    window.onload = function() {
        information();
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
                                <!-- <h1>Hello, <span>Welcome Here</span></h1> -->
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Personal Information</a></li>
                                    <li class="breadcrumb-item active">ข้อมูลส่วนตัว</li>

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
                                                <div id="full_name" class="user-profile-name"></div>

                                                <div class="user-job-title">นักศึกษาฝึกงาน</div>

                                                <div class="row">
                                                    <?php //if(false):
                                                    ?>
                                                    <div id="status_btn_search_image" style="display: none" class="user-send-message">
                                                        <button onclick="window.location.assign('./image_search.php') ;" class="btn btn-sm  btn-success btn-rounded" type="button">
                                                            <i class="ti-zoom-in"></i>&nbsp;&nbsp;ตรวจสอบภาพ</button>
                                                    </div>
                                                    <?php //else:
                                                    ?>
                                                    <div id="status_btn_save_image" style="display: none" class="user-send-message">
                                                        <button class="btn btn-danger btn-rounded" type="button" onclick="if(confirm('คุณสามารถบันทึกได้เพียงครั้งเดี่ยว')){ window.location.assign('./on_save_face.php') ;}">
                                                            <i class="ti-cloud-up"></i>&nbsp;&nbsp;สถานะไม่สมบูรณ์</button>
                                                        <?php //endif; 
                                                        ?>
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
                                                                    <span id="id_code" class="contact-skype"></span>
                                                                </div>
                                                                <div class="address-content">
                                                                    <span class="contact-title">ชื่อ:</span>
                                                                    <span id="name" class="contact-skype"></span>
                                                                </div>
                                                                <div class="email-content">
                                                                    <span class="contact-title">นามสกุล:</span>
                                                                    <span id="last_name" class="contact-email"></span>
                                                                </div>
                                                                <div class="email-content">
                                                                    <span class="contact-title">Email:</span>
                                                                    <span id="e_mail" class="contact-email"></span>
                                                                </div>
                                                                <div class="phone-content">
                                                                    <span class="contact-title">Phone:</span>
                                                                    <span id="phone" class="phone-number"></span>
                                                                </div>
                                                                <div class="phone-content">
                                                                    <span class="contact-title">Position:</span>
                                                                    <span id="position" class="contact-skype"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <script>
                                                            function information() {
                                                                var btn_search_image = document.getElementById("status_btn_search_image");
                                                                var btn_save_image = document.getElementById("status_btn_save_image");
                                                                var id_code = document.getElementById("id_code");
                                                                var name = document.getElementById("name");
                                                                var last_name = document.getElementById("last_name");
                                                                var e_mail = document.getElementById("e_mail");
                                                                var phone = document.getElementById("phone");
                                                                var position = document.getElementById("position");
                                                                var full_name = document.getElementById("full_name");


                                                                //  Input - Edit 
                                                                var input_name = document.getElementById('input-name');
                                                                var input_last_name = document.getElementById('input-lastn_name');
                                                                var input_email = document.getElementById('input-email');
                                                                var input_phone = document.getElementById('input-phone');
                                                                var input_pass = document.getElementById('input-pass');
                                                                var input_position = document.getElementById('input-position');

                                                                $.ajax({
                                                                    type: "POST",
                                                                    url: "./controller/con_per.php",
                                                                    data: {
                                                                        key: "information",
                                                                        id_mem: '<?php echo $id_mem; ?>'

                                                                    },
                                                                    success: function(result, textStatus, jqXHR) {
                                                                        // id_code.innerHTML = result;
                                                                        var json = JSON.parse(result);
                                                                        if (json != false) {
                                                                            full_name.innerHTML = json[0].name + ' ' + json[0].last_name;
                                                                            id_code.innerHTML = json[0].id_code;
                                                                            name.innerHTML = json[0].name;
                                                                            last_name.innerHTML = json[0].last_name;
                                                                            e_mail.innerHTML = json[0].e_mail;
                                                                            phone.innerHTML = json[0].phone;
                                                                            position.innerHTML = json[0].position;

                                                                            // set input Edit field
                                                                            input_name.value = json[0].name;
                                                                            input_last_name.value = json[0].last_name;
                                                                            input_email.value = json[0].e_mail;
                                                                            input_phone.value = json[0].phone;
                                                                            // input_pass.value = json[0].pass;
                                                                            input_position.value = json[0].position;


                                                                            password = json[0].pass;
                                                                            // alert(password);
                                                                            if (json[0].stu_face == "0") {
                                                                                btn_save_image.style = "display:block";
                                                                            } else {
                                                                                btn_search_image.style = "display:block";
                                                                            }
                                                                        } else {
                                                                            alert("แจ้งเตือนข้อผิดพลาดไม่สามารถแสดงข้อมูลได้")
                                                                        }

                                                                    },
                                                                    error: function(jqXHR, textStatus, errorThrown) {
                                                                        location.assign("../error/error-404.html");
                                                                    }
                                                                });
                                                            }
                                                        </script>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    
                                                        
                                                            <script>
                                                                // $("#backup").on('click', function() {
                                                                //     // alert("Back");
                                                                //     $.ajax({
                                                                //         type: "POST",
                                                                //         url: "./controller/backup.php",
                                                                //         data: {
                                                                //             key: "backup",
                                                                //             id_mem: "<?php echo $id_mem ?>"
                                                                //         },
                                                                //         success: function(result, textStatus, jqXHR) {
                                                                //             alert(result);
                                                                //         },
                                                                //         error: function(jqXHR, textStatus, errorThrown){

                                                                //         }
                                                                //     });
                                                                // });
                                                            </script>
                                                    </div>
                                                    <div class="user-send-message">
                                                        <!-- confirm('คุณต้องการแก้ไขข้อมูลส่วนตัวหรือไม่!') -->
                                                        <button id="btn-dialog-edit" class="btn btn-sm btn-warning btn-rounded" type="button" data-target="#edit">
                                                            <i class="ti-hummer"></i>&nbsp;&nbsp;แก้ไข</button>
                                                    </div>
                                                    <script>
                                                        //  onclick="edit_();"  
                                                        $("#btn-dialog-edit").on("click", function() {
                                                            var btn_dialog = document.getElementById('btn-dialog-edit');
                                                            if (confirm("Are you sure you")) {
                                                                $("#btn-dialog-edit").attr("data-toggle", "modal");
                                                            } else {
                                                                $("#btn-dialog-edit").attr("data-toggle", "");
                                                            }
                                                        });
                                                    </script>
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
                                                                        <div id="div-name" class="form-group">
                                                                            <label>User Name</label>
                                                                            <input id="input-name" type="text" class="form-control" placeholder="User Name">
                                                                            <p id="txt-name">กรุณากรอกชื่อตามความจริง</p>

                                                                            <script>
                                                                                $("#input-name").on("keyup", function() {
                                                                                    var str = $(this).val();
                                                                                    if (/^[ก-๏\s]+$/.test(str) != true && /^[a-zA-Z\s]+$/.test(str) != true && str.length != 0) {
                                                                                        document.getElementById("txt-name").innerHTML = "กรุณากรอกชื่อตามความจริง";
                                                                                        document.getElementById('div-name').className = 'form-group has-error';
                                                                                        accuracy_name = "";
                                                                                        return;
                                                                                    }
                                                                                    if (str.length == 0) {
                                                                                        document.getElementById("txt-name").innerHTML = "กรุณากรอกชื่อตามความจริง";
                                                                                        document.getElementById('div-name').className = 'form-group ';
                                                                                        accuracy_name = "";
                                                                                        return;
                                                                                    } else {
                                                                                        document.getElementById("txt-name").innerHTML = "สามารถใช้ชื่อนี้ได้";
                                                                                        document.getElementById('div-name').className = 'form-group has-success';
                                                                                        accuracy_name = "success";
                                                                                        return;
                                                                                    }
                                                                                });
                                                                            </script>
                                                                        </div>
                                                                        <div id="div-lastname" class="form-group">
                                                                            <label>Last Name</label>
                                                                            <input id="input-lastn_name" type="text" class="form-control" placeholder="Last Name">
                                                                            <p id="txt-lastname">กรุณากรอกนามสกุลตามความจริง</p>
                                                                            <script>
                                                                                $("#input-lastn_name").on("keyup", function() {
                                                                                    var str = $(this).val();
                                                                                    if (/^[ก-๏\s]+$/.test(str) != true && /^[a-zA-Z\s]+$/.test(str) != true && str.length != 0) {
                                                                                        document.getElementById("txt-lastname").innerHTML = "กรุณากรอกนามสกุลตามความจริง";
                                                                                        document.getElementById('div-lastname').className = 'form-group has-error';
                                                                                        accuracy_lastname = "";
                                                                                        return;
                                                                                    }
                                                                                    if (str.length == 0) {
                                                                                        document.getElementById("txt-lastname").innerHTML = "กรุณากรอกนามสกุลตามความจริง";
                                                                                        document.getElementById('div-lastname').className = 'form-group ';
                                                                                        accuracy_lastname = "";
                                                                                        return;
                                                                                    } else {
                                                                                        document.getElementById("txt-lastname").innerHTML = "กรุณากรอกนามสกุลตามความจริง";
                                                                                        document.getElementById('div-lastname').className = 'form-group has-success';
                                                                                        accuracy_lastname = "success";
                                                                                        return;
                                                                                    }
                                                                                });
                                                                            </script>
                                                                        </div>
                                                                        <div id="div-mail" class="form-group">
                                                                            <label>Email address</label>
                                                                            <input id="input-email" type="email" class="form-control" placeholder="Email">
                                                                            <p id="txt-mail">กรุณาระบุ E-Mail Address</p>
                                                                            <script>
                                                                                $("#input-email").on("keyup", function() {
                                                                                    var str = $(this).val();
                                                                                    // alert("Email");
                                                                                    // alert(str);
                                                                                    if (/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}/.test(str) != true && str.length != 0) {
                                                                                        document.getElementById('div-mail').className = 'form-group has-error';
                                                                                        document.getElementById("txt-mail").innerHTML = "ไม่สามารถใช้ E-Mail Address นี้ได้";
                                                                                        accuracy_mail = "";
                                                                                        return;
                                                                                    }
                                                                                    if (str.length == 0) {
                                                                                        document.getElementById('div-mail').className = 'form-group';
                                                                                        document.getElementById("txt-mail").innerHTML = "ไม่สามารถใช้ E-Mail Address นี้ได้";
                                                                                        accuracy_mail = "";
                                                                                        return;
                                                                                    } else {
                                                                                        document.getElementById('div-mail').className = 'form-group has-success';
                                                                                        document.getElementById("txt-mail").innerHTML = "";
                                                                                        accuracy_mail = "success";
                                                                                        return;
                                                                                    }
                                                                                });
                                                                            </script>
                                                                        </div>
                                                                        <div id="div-phone" class="form-group">
                                                                            <label>Phone Number</label>
                                                                            <input id="input-phone" type="text" class="form-control" placeholder="Phone Number">
                                                                            <p id="txt-phone">กรุณากรอกมือถือที่ติดต่อได้</p>
                                                                            <script>
                                                                                $("#input-phone").on("keyup", function() {
                                                                                    var str = $(this).val();
                                                                                    if (/[0-9]{3}[0-9]{3}[0-9]{4}/.test(str) != true && str.length != 0) {
                                                                                        document.getElementById("txt-phone").innerHTML = "กรุณากรอกมือถือที่ติดต่อได้";
                                                                                        document.getElementById('div-phone').className = 'form-group has-error';
                                                                                        accuracy_phone = "";
                                                                                        return;
                                                                                    } else if (str.length == 0) {
                                                                                        document.getElementById("txt-phone").innerHTML = "กรุณากรอกมือถือที่ติดต่อได้";
                                                                                        document.getElementById('div-phone').className = 'form-group ';
                                                                                        accuracy_phone = "";
                                                                                        return;
                                                                                    } else if (str.length > 10) {
                                                                                        document.getElementById("txt-phone").innerHTML = "กรุณากรอกมือถือที่ติดต่อได้";
                                                                                        document.getElementById('div-phone').className = 'form-group has-error';
                                                                                        accuracy_phone = "";
                                                                                    } else {
                                                                                        document.getElementById("txt-phone").innerHTML = "สามารถใช้เบอร์มือถือนี้ได้";
                                                                                        document.getElementById('div-phone').className = 'form-group has-success';
                                                                                        str_pho1 = str.substring(0, 3);
                                                                                        str_pho2 = str.substring(3, 6);
                                                                                        str_pho3 = str.substring(6, );
                                                                                        document.getElementById("input-phone").value = str_pho1 + str_pho2 + str_pho3
                                                                                        // $("#input-phone").attr("value", str_pho1 + "-" + str_pho2 + "-" + str_pho3);
                                                                                        // // value = str_pho1 + "-" + str_pho2 + "-" + str_pho3;
                                                                                        accuracy_phone = "success";
                                                                                        return;
                                                                                    }
                                                                                });
                                                                            </script>
                                                                        </div>

                                                                        <div id="div-position" class="form-group">
                                                                            <label>position</label>
                                                                            <input id="input-position" type="text" class="form-control" placeholder="position">
                                                                            <p id="txt-position">ตำแหน่งงานปัจจุบัน</p>
                                                                            <script>
                                                                                $("#input-position").on("keyup", function() {
                                                                                    var str = $(this).val();
                                                                                    if (str.length <= 4) {
                                                                                        document.getElementById("txt-position").innerHTML = "ตำแหน่งงานปัจจุบัน";
                                                                                        document.getElementById('div-position').className = 'form-group has-error';
                                                                                        accuracy_position = "";
                                                                                        return;
                                                                                    } else {
                                                                                        document.getElementById("txt-position").innerHTML = "";
                                                                                        document.getElementById('div-position').className = 'form-group has-success';
                                                                                        accuracy_position = "success";
                                                                                        return;
                                                                                    }
                                                                                });
                                                                            </script>
                                                                        </div>
                                                                        <div id="div-pass" style="display: none" class="form-group">
                                                                            <label>รหัสผ่านเดิมเพื่อยืนยัน</label>
                                                                            <input id="input-pass" type="password" class="form-control" placeholder="Password">
                                                                            <p id="txt-pass">กรุณาระบุรหัสผ่านเดิม</p>
                                                                            <script>
                                                                                $("#input-pass").on("keyup", function() {
                                                                                    var btn_edit = document.getElementById('btn_edit_save');
                                                                                    var str = $(this).val();
                                                                                    if (str.length == 0) {
                                                                                        // document.getElementById("txt-pass").innerHTML = "ระบุรหัสผ่านเดิม";
                                                                                        document.getElementById('div-pass').className = 'form-group';
                                                                                        accuracy_pass = "";
                                                                                        btn_edit.style.display = "none";
                                                                                        return;
                                                                                    } else if (password == str) {
                                                                                        // document.getElementById("txt-pass").innerHTML = "สามารถใช้รหัสผ่านนี้ได้";
                                                                                        document.getElementById('div-pass').className = 'form-group';
                                                                                        accuracy_pass = "success";
                                                                                        btn_edit.style.display = "block";

                                                                                        return;
                                                                                    } else {
                                                                                        // document.getElementById("txt-pass").innerHTML = "ใส่รหัสผ่านไม่ถุกต้อง";
                                                                                        document.getElementById('div-pass').className = 'form-group';
                                                                                        accuracy_pass = "";
                                                                                        btn_edit.style.display = "none";
                                                                                        return;
                                                                                    }
                                                                                });
                                                                            </script>
                                                                        </div>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input id="check-box" type="checkbox" onclick="check_box()"> Agree the terms and policy
                                                                                <script>
                                                                                    function check_box() {
                                                                                        var password = document.getElementById("div-pass");
                                                                                        var checkBox = document.getElementById("check-box");
                                                                                        if (checkBox.checked == true) {
                                                                                            password.style.display = "block";
                                                                                        } else {
                                                                                            // btn_edit.style.display = "none";
                                                                                            password.style.display = "none";
                                                                                        }
                                                                                    }
                                                                                </script>
                                                                            </label>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button id="dismiss" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button style="display:none;" id="btn_edit_save" type="button" class="btn btn-primary">SAVE</button>
                                                                    <script>
                                                                        $("#btn_edit_save").click(function() {
                                                                            // $("#btn_edit_save").attr("data-dismiss", "modal");
                                                                            var input_name = document.getElementById('input-name');
                                                                            var input_last_name = document.getElementById('input-lastn_name');
                                                                            var input_email = document.getElementById('input-email');
                                                                            var input_phone = document.getElementById('input-phone');
                                                                            var input_pass = document.getElementById('input-pass');
                                                                            var input_position = document.getElementById('input-position');

                                                                            if (
                                                                                accuracy_name == "success" &&
                                                                                accuracy_lastname == "success" &&
                                                                                accuracy_mail == "success" &&
                                                                                accuracy_pass == "success" &&
                                                                                accuracy_phone == "success" &&
                                                                                accuracy_position == "success"
                                                                            ) {
                                                                                // if (confirm("Are you sure you want")) {
                                                                                $.ajax({
                                                                                    type: "POST",
                                                                                    url: "./controller/con_per.php",
                                                                                    data: {
                                                                                        key: "btn_edit_save",
                                                                                        id_mem: "<?php echo $id_mem ?>",
                                                                                        name: input_name.value,
                                                                                        last_name: input_last_name.value,
                                                                                        email: input_email.value,
                                                                                        phone: input_phone.value,
                                                                                        // pass: input_pass.value,
                                                                                        position: input_position.value
                                                                                    },
                                                                                    success: function(result, textStatus, jqXHR) {
                                                                                        if (result == "success") {
                                                                                            swal("SUCCESS", "อัพเดตข้อมูลสำร็จ!", "success");
                                                                                            information();
                                                                                            $('#edit').modal('hide');
                                                                                        }else{
                                                                                            swal("Error", "ไม่สามารถอัพเดตข้อมูลได้!", "error");
                                                                                            $('#edit').modal('hide');
                                                                                        }
                                                                                    },
                                                                                    error: function(jqXHR, textStatus, errorThrown) {
                                                                                        // alert(jqXHR.status);
                                                                                        swal("Error", "เกิดข้อผลิดพลาดไม่สามารถเชื่อมต่อเซิฟเวอร์ได้", "error");
                                                                                        $('#edit').modal('hide');
                                                                                    }
                                                                                });
                                                                                // }

                                                                            } else {

                                                                                swal("", "ตรวจสอบข้อมูลอีกครั้ง!", "info");

                                                                                // swal("", "ตรวจสอบข้อมูลอีกครั้ง!", "info");
                                                                            }
                                                                        });

                                                                        function refresh() {
                                                                            // alert("Refresh");
                                                                            $("#btn_edit_save").attr("data-dismiss", "modal");

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
                    <!-- /# row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-title">
                                    <h4>ประวัติการใช้งานห้อง</h4>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered table table-hover ">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>ลำดับ</th>
                                                    <th>ห้อง</th>
                                                    <th>เวลาเข้า &nbsp;&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $tb_schedule_result = "";
                                                if ($show_tebelig = Database::query("SELECT rm.room_num ,sc.time_stamp FROM `schedule` as sc inner join `rooms` as rm on sc.id_room = rm.id_room  where sc.id_mem = '{$id_mem}' ORDER BY sc.time_stamp  ASC;", PDO::FETCH_ASSOC)) {
                                                    $i = 0;
                                                    foreach ($show_tebelig as $row) {
                                                        $i = $i + 1;
                                                        $date = date("H:i d/m/Y", strtotime($row['time_stamp']));
                                                        $tb_schedule_result = $tb_schedule_result .
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
                        </div>
                        <!-- /# column -->
                    </div>
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



    <script src="../../script/assets/js/lib/sweetalert/sweetalert.min.js"></script>
    <!-- <script src="../../script/assets/js/lib/sweetalert/sweetalert.init.js"></script> -->

    <script>
        document.querySelector('.sweet-wrong').onclick = function() {
            sweetAlert("Oops...", "Something went wrong !!", "error");
        };
        document.querySelector('.sweet-message').onclick = function() {
            swal("Hey, Here's a message !!")
        };
        document.querySelector('.sweet-text').onclick = function() {
            swal("Hey, Here's a message !!", "It's pretty, isn't it?")
        };
        document.querySelector('.sweet-success').onclick = function() {
            swal("Hey, Good job !!", "You clicked the button !!", "success")
        };
        document.querySelector('.sweet-confirm').onclick = function() {
            swal({
                    title: "Are you sure to delete ?",
                    text: "You will not be able to recover this imaginary file !!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it !!",
                    closeOnConfirm: false
                },
                function() {
                    swal("Deleted !!", "Hey, your imaginary file has been deleted !!", "success");
                });
        };
        document.querySelector('.sweet-success-cancel').onclick = function() {
            swal({
                    title: "Are you sure to delete ?",
                    text: "You will not be able to recover this imaginary file !!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it !!",
                    cancelButtonText: "No, cancel it !!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        swal("Deleted !!", "Hey, your imaginary file has been deleted !!", "success");
                    } else {
                        swal("Cancelled !!", "Hey, your imaginary file is safe !!", "error");
                    }
                });
        };
        document.querySelector('.sweet-image-message').onclick = function() {
            swal({
                title: "Sweet !!",
                text: "Hey, Here's a custom image !!",
                imageUrl: "assets/images/hand.jpg"
            });
        };
        document.querySelector('.sweet-html').onclick = function() {
            swal({
                title: "Sweet !!",
                text: "<span style='color:#ff0000'>Hey, you are using HTML !!<span>",
                html: true
            });
        };
        document.querySelector('.sweet-auto').onclick = function() {
            swal({
                title: "Sweet auto close alert !!",
                text: "Hey, i will close in 2 seconds !!",
                timer: 2000,
                showConfirmButton: false
            });
        };
        document.querySelector('.sweet-prompt').onclick = function() {
            swal({
                    title: "Enter an input !!",
                    text: "Write something interesting !!",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    inputPlaceholder: "Write something"
                },
                function(inputValue) {
                    if (inputValue === false) return false;
                    if (inputValue === "") {
                        swal.showInputError("You need to write something!");
                        return false
                    }
                    swal("Hey !!", "You wrote: " + inputValue, "success");
                });
        };
        document.querySelector('.sweet-ajax').onclick = function() {
            swal({
                    title: "Sweet ajax request !!",
                    text: "Submit to run ajax request !!",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                },
                function() {
                    setTimeout(function() {
                        swal("Hey, your ajax request finished !!");
                    }, 2000);
                });
        };
    </script>


    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
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
    <script src="../../script/assets/js/lib/data-table/datatables-init.js"></script>

</body>

</html>