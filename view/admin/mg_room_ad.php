<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar_ad.php")
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จัดการตารางห้อง</title>
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
                                    <li class="breadcrumb-item"><a href="./mg_room_ad.php">จัการห้อง</a></li>
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
                                                    <th>รหัสประจำเครื่อง</th>
                                                    <th>ชื่อห้อง</th>
                                                    <th>เวลา ปิด ไฟ</th>
                                                    <th>เวลา เปิด ไฟ</th>
                                                    <th class="text-center">สถานะไฟ</th>
                                                    <th class="text-center">
                                                        <a href="#" data-toggle="modal" data-target="#add_room" data-whatever="@mdo"><i class="ti-plus add_room">&nbsp;เพิ่มห้อง</i></a>
                                                    </th>
                                                </tr>
                                            </thead>



                                            <tbody id='tbb_mg_room'>

                                            </tbody>
                                            <style>
                                                .id_room_codefile:hover {
                                                    cursor: pointer;
                                                    color: green;
                                                }
                                            </style>
                                            <script>
                                                // tb_mg_room() 
                                                function tb_mg_room() {
                                                    // $('#tbb_mg_room').empty();
                                                    // $('#tb_mg_room').find('tbody').detach();
                                                    // $('#tb_mg_room').append($('<tbody>'));  
                                                    var tb_mg_room = $('#tb_mg_room').DataTable({
                                                        retrieve: true,
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
                                                        }
                                                    });
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
                                                            console.log(result)
                                                            var json = JSON.parse(result);
                                                            // tb_mg_room.delete();
                                                            $.each(json, function(key, val) {

                                                                var id_room = val['id_room'];
                                                                var room_id_code = val['room_id_code'];
                                                                var room_num = val['room_num'];
                                                                var room_dclose = val['room_dclose'].substr(0, 5);
                                                                var room_open = val['room_open'].substr(0, 5);
                                                                var status = val["room_fstatus"];


                                                                var btn_status;
                                                                if (status == '0') {
                                                                    btn_status = "<button type='button' onclick='ckick_btn_room_fstatus(" + val['id_room'] + ',' + status + ")' class='btn badge badge-danger'>Off</button>";
                                                                } else {
                                                                    btn_status = "<button type='button' onclick='ckick_btn_room_fstatus(" + val['id_room'] + ',' + status + ")'  class='btn badge badge-success'>On</button>";
                                                                }


                                                                var col1 = "<input type='hidden' name='' value='" + val['id_room'] + "'>" + '<p class="id_room_codefile">' + room_id_code + '</p>';
                                                                var col4 = '<div class="text-center">' +
                                                                    '<a class ="click_edit_search" href="#" data-toggle="modal" data-target="#edit_room" data-whatever="@mdo"><i class="ti-pencil"></i></a>' +
                                                                    '&nbsp;&nbsp;&nbsp;&nbsp;' + '<a id="seach_room_link" href="./room_search_ad.php?id=' + val['id_room'] + '"><i class="ti-search"></i></a>' +
                                                                    '</div>';



                                                                // tb_mg_room.clear();
                                                                tb_mg_room.row.add([
                                                                    col1,
                                                                    room_num,
                                                                    room_dclose,
                                                                    room_open,
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

                                                $("#tb_mg_room").on('click', '.id_room_codefile', function() {
                                                    // get the current row
                                                    var currentRow = $(this).closest("tr");
                                                    var id_room_txt = currentRow.find("td:eq(0) input[type='hidden']").val();


                                                    send_post_get('./controller/con_mg_room.php', {
                                                        key: "download_file_room",
                                                        id_room: id_room_txt,
                                                    }, 'POST');


                                                });


                                                $("#tb_mg_room").on('click', '#seach_room_link', function() {
                                                    // get the current row
                                                    var currentRow = $(this).closest("tr");
                                                    var id_room_txt = currentRow.find("td:eq(0) input[type='hidden']").val();


                                                    send_post_get("./room_search_ad.php", {
                                                        id: id_room_txt
                                                    }, 'GET');
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
                                                                <label>รหัสประจำเครื่อง</label>
                                                                <!-- <input id="edit-hidden-id_room" type="hidden" > -->
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
                                                            <div class="form-group">
                                                                <label>ตั้งเวลา เปิด</label>
                                                                <input id="edit_input_room_open" type="time" value="" class="form-control">
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
                                                        var id_room_edit = '';
                                                        $("#tb_mg_room").on('click', '.click_edit_search', function() {
                                                            // get the current row
                                                            var currentRow = $(this).closest("tr");
                                                            id_room_edit = currentRow.find("td:eq(0) input[type='hidden']").val();
                                                            var id_room_txt = currentRow.find("td:eq(0)").text();
                                                            var room_name_txt = currentRow.find("td:eq(1)").text();
                                                            var room_dclose_tex = currentRow.find("td:eq(2)").text();
                                                            var room_open_tex = currentRow.find("td:eq(3)").text();



                                                            // set values
                                                            $('#edit_input_id_room').val(id_room_txt);
                                                            $('#edit_input_room_name').val(room_name_txt);
                                                            $('#edit_input_room_dclose').val(room_dclose_tex);
                                                            $('#edit_input_room_open').val(room_open_tex);
                                                        });

                                                        $('#btn_edit_room').click(function() {
                                                            // get Value Edit

                                                            var id_room = id_room_edit;
                                                            var room_id_code = $('#edit_input_id_room').val();
                                                            var room_name = $('#edit_input_room_name').val();
                                                            var room_dclose = $('#edit_input_room_dclose').val();
                                                            var room_open = $('#edit_input_room_open').val();

                                                            // alert(id_room + " " + room_name + " " + room_id_code + " " + room_dclose);


                                                            // alert(id_room + ' ' + room_name + ' ' + room_dclose);

                                                            if (id_room != '' && room_name != '' && room_dclose != '') {
                                                                $.ajax({
                                                                    url: './controller/con_mg_room.php',
                                                                    type: 'POST',
                                                                    data: {
                                                                        key: 'btn_edit_room',
                                                                        id_room: id_room,
                                                                        room_id_code: room_id_code,
                                                                        room_name: room_name,
                                                                        room_dclose: room_dclose,
                                                                        room_open: room_open

                                                                    },
                                                                    success: function(result, textStatus, jqXHR) {
                                                                        console.log(result);
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
                                                                <label>รหัสประจำห้อง &nbsp;&nbsp;<a class="btn badge badge-success text-danger btn-random">สุม</a></label>
                                                                <input id='id_room' disabled type="text" class="form-control" placeholder="ID Room">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Room Name</label>
                                                                <input id='room_name' type="text" class="form-control" placeholder="Room Name">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>ตั้งเวลา ปิด</label>
                                                                <input id='room_dclose' type="time" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>ตั้งเวลา เปิด</label>
                                                                <input id='room_open' type="time" class="form-control">
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
                                                                function random_string(length) {
                                                                    var result = '';
                                                                    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                                                                    var cnaracters_ = '0123456789!@#$%^&*';
                                                                    var charactersLength = characters.length;
                                                                    for (var i = 0; i < length; i++) {
                                                                        result += characters.charAt(Math.floor(Math.random() *
                                                                            charactersLength));
                                                                    }
                                                                    return result;
                                                                }
                                                                $('.add_room').click(function() {
                                                                    // alert(random_string(8));
                                                                    $('#id_room').val(random_string(29));
                                                                });
                                                                $('.btn-random').click(function() {
                                                                    $('#id_room').val(random_string(29));
                                                                });
                                                                $('#btn_create_room').click(function() {
                                                                    // alert('Room created');
                                                                    var room_id_code = $('#id_room').val();
                                                                    var room_name = $('#room_name').val();
                                                                    var room_dclose = $('#room_dclose').val();
                                                                    var room_open = $('#room_open').val();
                                                                    // alert(room_dclose);

                                                                    if (room_id_code != '' && room_name != '' && room_dclose != '' && room_open != '') {
                                                                        $.ajax({
                                                                            url: './controller/con_mg_room.php',
                                                                            type: 'POST',
                                                                            data: {
                                                                                key: 'btn_create_room',
                                                                                room_id_code: room_id_code,
                                                                                room_name: room_name,
                                                                                room_dclose: room_dclose,
                                                                                room_open: room_open

                                                                            },
                                                                            success: function(result, textStatus, jqXHR) {
                                                                                // alert(result);
                                                                                if (result == "success") {
                                                                                    swal('เพิ่มห้องสำเร็จ', {
                                                                                        icon: "success",
                                                                                        buttons: false,
                                                                                        timer: 1000,
                                                                                    });

                                                                                    $('#room_name').val('');
                                                                                    $('#room_dclose').val('');


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


                                                                                    // $('#id_room').val('');


                                                                                    tb_mg_room();
                                                                                    $('#btn_create_room').attr('ata-dismiss', 'modal');
                                                                                }
                                                                            },
                                                                            error: function(jqXHR, textStatus, errorThrown) {
                                                                                swal(errorThrown, {
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
                            <p>2022 © ITT Software.</p>
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