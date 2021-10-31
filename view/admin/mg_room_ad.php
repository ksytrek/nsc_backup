<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar_ad.php")
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Management Rooms Admin Dashboard</title>
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
                                    <li class="breadcrumb-item"><a href="./mg_room_ad.php">Management Room</a></li>
                                    <li class="breadcrumb-item active">จัดการตารางห้อง</li>
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
                                <div class="card-title">
                                    <h4>จัดการตารางห้อง</h4>
                                </div>
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>รหัสห้อง</th>
                                                    <th>ชื่อห้อง</th>
                                                    <th>เวลา ปิด ไฟ</th>
                                                    <th class="text-center">สถานะไฟ</th>
                                                    <th class="text-center">
                                                        <a href="#" data-toggle="modal" data-target="#add_room" data-whatever="@mdo"><i class="ti-plus">&nbsp;เพิ่มห้อง</i></a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>106625</td>
                                                    <td>นายสมพล วิลา</td>
                                                    <td>14:60 น.</td>
                                                    <td class="text-center"><button class=" btn badge badge-danger">Off</button></td>
                                                    <th class="text-center">
                                                        <a href="#" data-toggle="modal" data-target="#edit_room" data-whatever="@mdo"><i class="ti-pencil"></i></a>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <a href="./room_search_ad.php"><i class="ti-search"></i></a>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td>13390516</td>
                                                    <td>นายรักนะ วรรณะ</td>
                                                    <td>18:00 น.</td>
                                                    <td class="text-center"><a><button class=" btn badge badge-success">On</button></a></td>
                                                    <th class="text-center">
                                                        <a href="#" data-toggle="modal" data-target="#edit_room" data-whatever="@mdo"><i class="ti-pencil"></i></a>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <a href="./room_search_ad.php"><i class="ti-search"></i></a>
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="modal fade" id="edit_room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลห้อง</h5>
                                                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="false">&times;</span>
                                                                    </button> -->
                                                    </div>
                                                    <div class="modal-body">
                                                    <form>
                                                            <div class="form-group">
                                                                <label>ID Room</label>
                                                                <input type="text" class="form-control" placeholder="ID Room">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Room Name</label>
                                                                <input type="text" class="form-control" placeholder="Room Name">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>ตั้งเวลา ปิด</label>
                                                                <input type="time" value="10:50" class="form-control" >
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
                                                var exampleModal = document.getElementById('edit_room')
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
                                        
                                        <div class="modal fade" id="add_room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลห้อง</h5>
                                                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="false">&times;</span>
                                                                    </button> -->
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="form-group">
                                                                <label>ID Room</label>
                                                                <input type="text" class="form-control" placeholder="ID Room">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Room Name</label>
                                                                <input type="text" class="form-control" placeholder="Room Name">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>ตั้งเวลา ปิด</label>
                                                                <input type="time" class="form-control" >
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
                                                var exampleModal = document.getElementById('add_room')
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






















                <section id="main-content">

                    <?php
                    // include_once("./report_dasboard_ad.php")
                    ?>

                </section>

            </div>
        </div>
    </div>
    <!-- scripit init-->
    <script>$(document).ready(function() {$('#dataTable').DataTable();});</script>
    <script src="../../script/assets/js/lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- <script src="../../script/assets/js/lib/data-table/datatables.min.js"></script> -->
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