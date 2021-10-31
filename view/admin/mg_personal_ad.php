<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar_ad.php")
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
                                        <table class="table table-bordered" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>รหัสประจำตัว</th>
                                                    <th>ชื่อ - สกุล</th>
                                                    <th>Position</th>
                                                    <th class="text-center">อัพโหลด</th>
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
                                    </div>
                                </div>

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
                                                            <option <?php echo "x" == 'x' ? "selected" : '' ?>>3</option>
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
                                    <script>
                                        var exampleModal = document.getElementById('edit_personal')
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
                                <div class="modal fade" id="add_personal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลส่วนตัว</h5>
                                                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="false">&times;</span>
                                                                    </button> -->
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label>รหัสประจำตัว</label>
                                                        <input type="text" class="form-control" placeholder="รหัสประจำตัว">
                                                    </div>
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
                                                            <option selected dismiss></option>
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
                                        var exampleModal = document.getElementById('add_personal')
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
                            <!-- /# card -->
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->

                </section>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer">
                            <p>2018 © Admin Board. - <a href="#">example.com</a></p>
                        </div>
                    </div>
                </div>

                <!-- /# row -->
                <!-- <section id="main-content">

                    <?php
                    // include_once("./report_dasboard_ad.php")
                    ?>

                </section> -->

            </div>
        </div>
    </div>


    <!-- scripit init-->
    <!-- <script src="../../script/assets/js/lib/data-table/datatables.min.js"></script> -->
    
    <script>$(document).ready(function() {$('#dataTable').DataTable();});</script>
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