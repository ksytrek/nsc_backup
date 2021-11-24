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
<script>
    $(document).ready(function() {
        // tb_mg_room();
        $('#div_btn_create').hide();
        $('#div_btn_edit').hide();

    });

    window.onload = function() {
        tb_mg_room();
    };

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
    k
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
                                        <table class="table table-bordered" id="tb_mg_room">
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
                                            <tbody id='tbb_mg_room'>

                                            </tbody>
                                            <script>
                                                // tb_mg_room() 
                                                function tb_mg_room() {
                                                    // $('#tbb_mg_room').empty();
                                                    // $('#tb_mg_room').find('tbody').detach();
                                                    // $('#tb_mg_room').append($('<tbody>'));  
                                                    var tb_mg_room = $('#tb_mg_room').DataTable();
                                                    // $("#tb_mg_room-table-id").empty();
                                                    tb_mg_room.clear();

                                                    var counter = 1;

                                                    $.ajax({
                                                        url: './controller/con_mg_room.php',
                                                        type: 'POST',
                                                        data: {
                                                            key: 'tb_mg_room'
                                                        },
                                                        success: function(result, textStatus, jqXHR) {
                                                            // alert(result);
                                                            var json = JSON.parse(result);
                                                            // tb_mg_room.delete();
                                                            $.each(json, function(key, val) {

                                                                var id_room = val['id_room'];
                                                                var room_num = val['room_num'];
                                                                var room_dclose = val['room_dclose'].substr(0, 5);
                                                                var status = val["room_fstatus"];


                                                                var btn_status;
                                                                if (status == '0') {
                                                                    btn_status = "<button type='button' onclick='ckick_btn_room_fstatus(" + val['id_room'] + ',' + status + ")' class='btn badge badge-danger'>Off</button>";
                                                                } else {
                                                                    btn_status = "<button type='button' onclick='ckick_btn_room_fstatus(" + val['id_room'] + ',' + status + ")'  class='btn badge badge-success'>On</button>";
                                                                }


                                                                var col4 = '<div class="text-center">' +
                                                                    '<a class ="click_edit_search" href="#" data-toggle="modal" data-target="#edit_room" data-whatever="@mdo"><i class="ti-pencil"></i></a>' +
                                                                    '&nbsp;&nbsp;&nbsp;&nbsp;' + '<a id="seach_room_link" href="#"><i class="ti-search"></i></a>' +
                                                                    '</div>'
                                                                // tb_mg_room.clear();
                                                                tb_mg_room.row.add([
                                                                    id_room,
                                                                    room_num,
                                                                    room_dclose,
                                                                    btn_status,
                                                                    col4
                                                                ]).draw(true);
                                                            });
                                                            // $('#tb_mg_room').empty();
                                                            // $('#tb_mg_room').DataTable();
                                                        },
                                                        error: function(jqXHR, textStatus, errorThrown) {

                                                        }

                                                    });
                                                }

                                                $("#tb_mg_room").on('click', '#seach_room_link', function() {
                                                    // get the current row
                                                    var currentRow = $(this).closest("tr");
                                                    var id_room_txt = currentRow.find("td:eq(0)").text();


                                                    send_post_get("./room_search_ad.php",{id:id_room_txt},'GET');
                                                });

                                                function ckick_btn_room_fstatus(id_room, status) {

                                                    if (confirm(status == "0" ? "you want to turn on the light" : "you want to turn off the light")) {
                                                        $.ajax({
                                                            url: "./controller/con_admin.php",
                                                            type: "POST",
                                                            data: {
                                                                key: "ckick_btn_room_fstatus",
                                                                id_room: id_room,
                                                                status: status
                                                            },
                                                            success: function(result, textStatus, jqXHR) {
                                                                // alert(result)
                                                                swal(result, {
                                                                    icon: "success",
                                                                    buttons: false,
                                                                    timer: 1000,
                                                                });

                                                                tb_mg_room();

                                                            },
                                                            error: function(jqXHR, textStatus, errorThrown) {
                                                                alert(errorThrown);
                                                            }
                                                        });
                                                    }


                                                }
                                            </script>


                                        </table>
                                        <!-- <button id='add_ee' type="button" class="btn">Add</button> -->
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
                                                                <input id="edit_input_id_room" type="text" disabled class="form-control" placeholder="ID Room">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Room Name</label>
                                                                <input id="edit_input_room_name" type="text" class="form-control" placeholder="Room Name">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>ตั้งเวลา ปิด</label>
                                                                <input id="edit_input_room_dclose" type="time" value="" class="form-control">
                                                            </div>


                                                            <div class="checkbox">
                                                                <label>
                                                                    <input id='check_edit_room' type="checkbox"> Agree the terms and policy
                                                                </label>
                                                                <script>
                                                                    // $('#check_show_create').
                                                                    $('#check_edit_room').click(function() {
                                                                        if ($('#check_edit_room').prop('checked') == true) {
                                                                            // alert('OK');
                                                                            $('#div_btn_edit').show();
                                                                        } else {
                                                                            $('#div_btn_edit').hide();

                                                                            // alert('Error');
                                                                        }
                                                                    });
                                                                </script>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <div id='div_btn_edit'><button id='btn_edit_room' type="button" class="btn btn-primary">SAVE</button></div>
                                                    </div>

                                                    <script>
                                                        $("#tb_mg_room").on('click', '.click_edit_search', function() {
                                                            // get the current row
                                                            var currentRow = $(this).closest("tr");
                                                            var id_room_txt = currentRow.find("td:eq(0)").text();
                                                            var room_name_txt = currentRow.find("td:eq(1)").text();
                                                            var room_dclose_tex = currentRow.find("td:eq(2)").text();



                                                            // set values
                                                            $('#edit_input_id_room').val(id_room_txt);
                                                            $('#edit_input_room_name').val(room_name_txt);
                                                            $('#edit_input_room_dclose').val(room_dclose_tex);
                                                        });

                                                        $('#btn_edit_room').click(function() {
                                                            // get Value Edit
                                                            var id_room = $('#edit_input_id_room').val();
                                                            var room_name = $('#edit_input_room_name').val();
                                                            var room_dclose = $('#edit_input_room_dclose').val();


                                                            // alert(id_room + ' ' + room_name + ' ' + room_dclose);

                                                            if (id_room != '' && room_name != '' && room_dclose != '') {
                                                                $.ajax({
                                                                    url: './controller/con_mg_room.php',
                                                                    type: 'POST',
                                                                    data: {
                                                                        key: 'btn_edit_room',
                                                                        id_room: id_room,
                                                                        room_name: room_name,
                                                                        room_dclose: room_dclose

                                                                    },
                                                                    success: function(result, textStatus, jqXHR) {
                                                                        // alert(result);
                                                                        if (result == "success") {
                                                                            swal('แกไขห้องสำเร็จ', {
                                                                                icon: "success",
                                                                                buttons: false,
                                                                                timer: 1000,
                                                                            });
                                                                            tb_mg_room();
                                                                            $('#edit_room').modal('hide');
                                                                            // $('#btn_edit_room').attr('ata-dismiss', 'modal');
                                                                            // $('#btn_create_room').attr('ata-dismiss','modal');
                                                                        } else {
                                                                            // alert(result);
                                                                            swal('กรุณาตรวจสอบข้อมูล', {
                                                                                icon: "warning",
                                                                                buttons: false,
                                                                                timer: 1000,
                                                                            });
                                                                            tb_mg_room();
                                                                            // $('#btn_edit_room').attr('ata-dismiss', 'modal');
                                                                        }

                                                                        // $('#btn_edit_room').attr('ata-dismiss', 'modal');

                                                                    },
                                                                    error: function(jqXHR, textStatus, errorThrown) {
                                                                        swal('เกิดข้อผิดพลาด', {
                                                                            icon: "error",
                                                                            buttons: false,
                                                                            timer: 1000,
                                                                        });
                                                                    }
                                                                });
                                                            } else {
                                                                swal('กรุณาตรวจสอบ ข้อมูล', {
                                                                    icon: "warning",
                                                                    buttons: false,
                                                                    timer: 1500,
                                                                });
                                                            }
                                                            // alert(id_room + " " + room_name + " " + room_dclose);

                                                        });
                                                    </script>
                                                </div>
                                            </div>

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
                                                                <input id='id_room' type="text" class="form-control" placeholder="ID Room">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Room Name</label>
                                                                <input id='room_name' type="text" class="form-control" placeholder="Room Name">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>ตั้งเวลา ปิด</label>
                                                                <input id='room_dclose' type="time" class="form-control">
                                                            </div>


                                                            <div class="checkbox">
                                                                <label>
                                                                    <input id='check_show_create' type="checkbox"> Agree the terms and policy
                                                                </label>
                                                                <script>
                                                                    // $('#check_show_create').
                                                                    $('#check_show_create').click(function() {
                                                                        if ($('#check_show_create').prop('checked') == true) {
                                                                            // alert('OK');
                                                                            $('#div_btn_create').show();
                                                                        } else {
                                                                            $('#div_btn_create').hide();

                                                                            // alert('Error');
                                                                        }
                                                                    });
                                                                </script>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button id='close_create_room' type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <div id='div_btn_create'>
                                                            <button id='btn_create_room' type="button" class="btn btn-primary">SAVE</button>
                                                            <script>
                                                                $('#btn_create_room').click(function() {
                                                                    // alert('Room created');
                                                                    var id_room = $('#id_room').val();
                                                                    var room_name = $('#room_name').val();
                                                                    var room_dclose = $('#room_dclose').val();
                                                                    // alert(room_dclose);

                                                                    if (id_room != '' && room_name != '' && room_dclose != '') {
                                                                        $.ajax({
                                                                            url: './controller/con_mg_room.php',
                                                                            type: 'POST',
                                                                            data: {
                                                                                key: 'btn_create_room',
                                                                                id_room: id_room,
                                                                                room_name: room_name,
                                                                                room_dclose: room_dclose

                                                                            },
                                                                            success: function(result, textStatus, jqXHR) {
                                                                                // alert(result);
                                                                                if (result == "success") {
                                                                                    swal('เพิ่มห้องสำเร็จ', {
                                                                                        icon: "success",
                                                                                        buttons: false,
                                                                                        timer: 1000,
                                                                                    });
                                                                                    tb_mg_room();
                                                                                    $('#add_room').modal('hide');
                                                                                    // $('#btn_create_room').attr('ata-dismiss','modal');
                                                                                } else {
                                                                                    // alert(result);
                                                                                    swal('กรุณาตรวจสอบ รหัสห้อง ซ้ำกันหรือไม่', {
                                                                                        icon: "warning",
                                                                                        buttons: false,
                                                                                        timer: 1000,
                                                                                    });
                                                                                    tb_mg_room();
                                                                                    $('#btn_create_room').attr('ata-dismiss', 'modal');
                                                                                }
                                                                            },
                                                                            error: function(jqXHR, textStatus, errorThrown) {
                                                                                swal('เกิดข้อผิดพลาด', {
                                                                                    icon: "error",
                                                                                    buttons: false,
                                                                                    timer: 1000,
                                                                                });
                                                                            }
                                                                        });
                                                                    } else {
                                                                        swal('กรุณาตรวจสอบ ข้อมูล', {
                                                                            icon: "warning",
                                                                            buttons: false,
                                                                            timer: 1500,
                                                                        });
                                                                    }

                                                                });

                                                                $('#close_create_room').click(function() {
                                                                    $('#add_room').modal('hide');
                                                                    tb_mg_room();
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
    <!-- <script>$(document).ready(function() {$('#tb_mg_room').DataTable();});</script> -->
    <script src="../../script/assets/js/lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- <script src="../../script/assets/js/lib/data-table/datatables.min.js"></script> -->
    <!-- <script src="../../script/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.flash.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/datatables-init.js"></script> -->
</body>

</html>