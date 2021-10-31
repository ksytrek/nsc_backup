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
                <section id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="user-profile">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="user-profile-name">สมพล วิลา</div>
                                                <div class="user-job-title">ผู้ดูแลระบบ</div>
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
                                                                    <span class="contact-skype">สมพล</span>
                                                                </div>
                                                                <div class="email-content">
                                                                    <span class="contact-title">Email:</span>
                                                                    <span class="contact-email">std.62122710108@ubru.ac.th</span>
                                                                </div>
                                                                <div class="phone-content">
                                                                    <span class="contact-title">รหัสผ่าน:</span>
                                                                    <a id="click-show" class="user-job-title1" href="#" onclick="show()" >*******</a>
                                                                    <span  class="contact-email" id="show-pass"></span>
                                                                </div>
                                                                <script>
                                                                    function show() {
                                                                        document.getElementById('show-pass').innerHTML ="123456789";
                                                                        document.getElementById('click-show').style.display = "none";
                                                                    }
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                            
                                                    <div class="user-send-message">
                                                        <button class="btn btn-sm btn-warning btn-rounded" type="button" data-toggle="modal" data-target="#edit">
                                                            <i class="ti-hummer"></i>&nbsp;&nbsp;แก้ไข</button>
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
                                                                            <label>Email address</label>
                                                                            <input type="email" class="form-control" placeholder="Email">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>New Password </label>
                                                                            <input type="password" class="form-control" placeholder="Password">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Current Password</label>
                                                                            <input type="password" class="form-control" placeholder="Password">
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
</body>

</html>