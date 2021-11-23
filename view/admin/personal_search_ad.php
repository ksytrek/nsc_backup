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
        <title>Focus Admin: Creative Admin Dashboard</title>
        <!-- Styles -->
        <link href="../../script/assets/css/lib/sweetalert/sweetalert.css" rel="stylesheet">

        <link href="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    </head>

    <body>
        <script>

            const ID_MEM = '<?php echo $id_mem; ?>';
            window.onload = function() {
                information_person_info();
            }


            var accuracy_name = "";
            var accuracy_lastname = "";
            var accuracy_mail = "";
            var accuracy_phone = "";
            var accuracy_pass = "";
            var accuracy_position = "";

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
                    url: "./controller/con_admin.php",
                    data: {
                        key: "information_person_info",
                        id_mem: '<?php echo $id_mem; ?>'

                    },
                    success: function(result, textStatus, jqXHR) {
                        // alert(result);
                        console.log(result);



                        // id_code.innerHTML = result;
                        var json = JSON.parse(result);
                        if (json != false) {
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
                                // $("#upload_image").attr("style", "display:block");
                                // $("#click-show-image").attr("style", "display:none");
                                $(".div-btn-show-image").hide();
                                $('.div-btn-upload-image').show();

                                // btn_save_image.style = "display:block";
                                // btn_search_image.style = "display:none";
                            } else {
                                // $("#upload_image").attr("style", "display:none");
                                // $("#click-show-image").attr("style", "display:block");
                                $(".div-btn-show-image").show();
                                $('.div-btn-upload-image').hide();
                                // btn_search_image.style = "display:block";
                                // btn_save_image.style = "display:none";
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
                                                                <i class="ti-alert"></i>&nbsp;&nbsp;ลบบุคลากร</button>
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
                                                                                <input type="text" class="form-control input-name" placeholder="User Name">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Last Name</label>
                                                                                <input type="email" class="form-control input-last_name" placeholder="Last Name">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Email address</label>
                                                                                <input type="email" class="form-control input-e_mail" placeholder="Email">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Password</label>
                                                                                <input type="password" class="form-control input-pass" placeholder="Password">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>position</label>
                                                                                <input type="text" class="form-control input-position" placeholder="Position">
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
                                                            <script>
                                                                var exampleModal = document.getElementById('edit')
                                                                exampleModal.addEventListener('show.bs.modal', function(event) {
                                                                    // Button that triggered the modal
                                                                    var button = event.relatedTarget
                                                                    // Extract info from data-bs-* attributes
                                                                    var recipient = button.getAttribute('data-bs-whatever')
                                                                    // If necessary, you could initiate an AJAX request here
                                                                    // and then do the updating in a callback.
                                                                    //
                                                                    // Update the modal's content.
                                                                    var modalTitle = exampleModal.querySelector('.modal-title')
                                                                    var modalBodyInput = exampleModal.querySelector('.modal-body input')

                                                                    modalTitle.textContent = 'New message to ' + recipient
                                                                    modalBodyInput.value = recipient
                                                                })
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
                        <!-- /# row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-title">
                                        <h4>ประวัติการใช้งานห้อง</h4>

                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>ลำดับ</th>
                                                        <th>ห้อง</th>
                                                        <th>เวลา &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- <tr>
                                                        <td>1</td>
                                                        <td>วิทยาการ 304</td>
                                                        <td>09:25 น. 18/10/64 </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>คณิต 654</td>
                                                        <td>09:25 น. 18/10/64 </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>วิทยาการ 304</td>
                                                        <td>09:25 น. 18/10/64 </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>คณิต 654</td>
                                                        <td>09:25 น. 18/10/64 </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>วิทยาการ 304</td>
                                                        <td>09:25 น. 18/10/64 </td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>คณิต 654</td>
                                                        <td>09:25 น. 18/10/64 </td>
                                                    </tr> -->
                                                </tbody>
                                            </table>
                                            <script>
                                                function get_tb_eligibility_person() {
                                                    $.ajax({
                                                        url:"",
                                                        type:"POST",
                                                        data: {
                                                            key : "get_tb_eligibility_person",
                                                            id_mem : ID_MEM
                                                        },
                                                        success: function(result, textStatus, jqXHR) {
                                                            alert(result);
                                                        },
                                                        error: function(jqXHR, textStatus, errorThrown){

                                                        }
                                                    
                                                    });
                                                    for (var i = 0; i <= 20; i++) {
                                                        $("#bootstrap-data-table-export").find('tbody')
                                                            .append($('<tr>')
                                                                .append($('<td>')
                                                                    .text('1')
                                                                ).append($('<td>')
                                                                    .text('คณิต')
                                                                ).append($('<td>')
                                                                    .text('09:25 น. 18/10/64 ')
                                                                )
                                                            );
                                                    }
                                                }
                                                get_tb_eligibility_person();
                                            </script>
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
<?php
endif;
?>

</html>