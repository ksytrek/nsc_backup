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
    <!-- Styles -->
    <link href="../../script/assets/css/lib/sweetalert/sweetalert.css" rel="stylesheet">


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
                                    <li class="breadcrumb-item"><a href="./mg_room_ad.php">Management Room</a></li>
                                    <li class="breadcrumb-item active">ห้อง 3011</li>

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
                                                <div class="user-profile-name">ห้อง :</div>
                                                <div class="user-profile-name">วิทคอม 3012578</div>
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
                                                                    <span class="contact-skype">5645185156</span>
                                                                </div>
                                                                <div class="address-content">
                                                                    <span class="contact-title">ชื่อห้อง:</span>
                                                                    <span class="contact-skype">วิทคอม 3012578</span>
                                                                </div>
                                                                <div class="email-content">
                                                                    <span class="contact-title">เวลาปิด:</span>
                                                                    <span class="contact-email">18:20 น.</span>
                                                                </div>
                                                                <div class="email-content">
                                                                    <span class="contact-title">สถานะไฟ:</span>
                                                                    <span class="contact-email"><span class="badge badge-danger">Off</span></span>
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
                    <section id="main-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-title">
                                        <h4>รายชื่อบุคลากรที่มีสิทธิ์เข้าห้อง</h4>
                                    </div>
                                    <div class="bootstrap-data-table-panel">
                                        <div class="table-responsive">
                                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>รหัสประจำตัว</th>
                                                        <th>ชื่อบุคลากร</th>
                                                        <th class="text-center">รายละเอียด</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1339900662225</td>
                                                        <td>นายสมพล วิลา</td>
                                                        <th class="text-center">

                                                            <a href="#"><i class="ti-search"></i></a>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td>1339906884516</td>
                                                        <td>นายรักนะ วรรณะ</td>
                                                        <th class="text-center">

                                                            <a href="#"><i class="ti-search"></i></a>
                                                        </th>
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
                                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
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



    <script src="../../script/assets/js/lib/data-table/datatables.min.js"></script>
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