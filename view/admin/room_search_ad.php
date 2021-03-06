<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar_ad.php");
if (isset($_GET['id'])) {
    $id_room = $_GET['id'];
    $sql = "SELECT * FROM `rooms` WHERE id_room = $id_room;";
    $search = Database::query($sql, PDO::FETCH_ASSOC);
    $row_room = $search->fetch(PDO::FETCH_ASSOC);
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ข้อมูลห้อง - <?php echo $row_room['room_num'] ?></title>

    <link href="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<script>
    const NAME_ROOM = '<?php echo $row_room['room_num'] ?>';
    const ID_ROOM = '<?php echo $id_room ?>';
    $(document).ready(function() {
        search_room_info();
        $('#div_btn_edit').hide();
    });


    // ฟังก์ชัน เปิด - ปิด ไฟ
    function ckick_btn_room_fstatus(id_room, status) {

        // if (confirm(status == "0" ? "you want to turn on the light" : "you want to turn off the light")) {
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

                search_room_info();

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
        // }


    }
    // ฟังก์ชัน เปิด - ปิด ประตู
    // ckick_btn_room_door
    function ckick_btn_room_door(id_room, status) {

        if (confirm(status == "0" ? "you want to turn on the Door" : "you want to turn off the Door")) {
            $.ajax({
                url: "./controller/con_room_search_ad.php",
                type: "POST",
                data: {
                    key: "ckick_btn_room_door",
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

                    search_room_info();

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }


    }

    // ฟังก์ชัน ส่งข้อมูลไปยังหน้าที่ต้องการ
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

    // แสดงข้อมูลห้องเริ่มต้น
    function search_room_info() {
        $.ajax({
            url: "./controller/con_room_search_ad.php",
            type: "POST",
            data: {
                key: 'search_room_info',
                id_room: ID_ROOM
            },
            success: function(result, textStatus, jqXHR) {
                // alert(result);
                // swal('เกิดข้อผิดพลาด','success','success');

                var json = JSON.parse(result);



                var btn_status = '';
                var status = json[0].room_fstatus;
                // if (status == '0') {
                //     // alert(status);
                //     btn_status = "<button type='button' onclick='ckick_btn_room_fstatus(" + json[0].id_room + ',' + status + ")' class='btn badge badge-danger'>Off</button>";
                // } else {
                //     // alert(status);
                //     btn_status = "<button type='button' onclick='ckick_btn_room_fstatus(" + json[0].id_room + ',' + status + ")'  class='btn badge badge-success'>On</button>";
                // }

                if (status == '0') {
                    btn_status = "<button type='button'  onclick='ckick_btn_room_fstatus(" + json[0].id_room + ',' + status + ")' class='btn badge badge-danger'>Off</button>";
                } else if (status == '1') {
                    btn_status = "<button type='button' onclick='ckick_btn_room_fstatus(" + json[0].id_room + ',' + status + ")'  class='btn badge badge-success'>On</button>";
                } else {
                    btn_status = "<button type='button' onclick='ckick_btn_room_fstatus(" + json[0].id_room + ',' + status + ")'  class='btn badge badge-primary'>Auto</button>";
                }

                var btn_door = '';
                var status_door = json[0].status_door;
                if (status_door == '0') {
                    // alert(status);
                    btn_door = "<button type='button' onclick='ckick_btn_room_door(" + json[0].id_room + ',' + status_door + ")' class='btn badge badge-danger'>Off</button>";
                } else {
                    // alert(status);
                    btn_door = "<button type='button' onclick='ckick_btn_room_door(" + json[0].id_room + ',' + status_door + ")'  class='btn badge badge-success'>On</button>";
                }

                // alert(json['0']['id_room']);
                $('.name_rooom').html(json[0].room_num);

                $('.info_id_room').html(json[0].room_id_code);
                $('.info_room_num').html(json[0].room_num);
                $('.info_room_dclose').html(json[0].room_dclose.substr(0, 5));
                $('.info_room_open').html(json[0].room_open.substr(0, 5));
                $('.info_room_fstatus').html(btn_status);
                $('.info_room_door').html(btn_door);


                $('#edit_input_id_room').val(json[0].room_id_code);
                $('#edit_input_room_name').val(json[0].room_num);
                $('#edit_input_room_dclose').val(json[0].room_dclose.substr(0, 5))
                $('#edit_input_room_open').val(json[0].room_open.substr(0, 5))



                // $('.info_room_fstatus').html(json[0].room_fstatus == 0 ? '<span class="badge badge-danger">Off</span>' : '<span class="badge badge-success">On</span>');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('ไม่สามารถแสดงข้อมูลได้!!');
                history.back(1);
            }
        });
        // $('.info_room_fstatus').html('<span class="badge badge-success">On</span>');

    }
    // <span class="badge badge-danger">Off</span>
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
                                    <li class="breadcrumb-item active">ตรวจสอบห้อง</li>

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
                                                <div class="user-profile-name">ชื่อห้อง :</div>
                                                <div class="user-profile-name name_rooom"></div>
                                                <div class="user-job-title"></div>

                                                <!-- <div class="row">
                                                    <div class="user-send-message">
                                                        <button class="btn btn-sm  btn-success btn-rounded" type="button">
                                                            <i class="ti-zoom-in"></i>&nbsp;&nbsp;เพิ่มสิทธิ์เข้าห้อง</button>
                                                    </div>

                                                </div> -->
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
                                                                    <span class="contact-skype info_id_room"></span>
                                                                </div>
                                                                <div class="address-content">
                                                                    <span class="contact-title">ชื่อห้อง:</span>
                                                                    <span class="contact-skype info_room_num"></span>
                                                                </div>
                                                                <div class="email-content">
                                                                    <span class="contact-title">เวลาปิด:</span>
                                                                    <span class="contact-email info_room_dclose"></span>
                                                                </div>
                                                                <div class="email-content">
                                                                    <span class="contact-title">เวลาเปิด:</span>
                                                                    <span class="contact-email info_room_open"></span>
                                                                </div>
                                                                <div class="email-content">
                                                                    <span class="contact-title">สถานะไฟ:</span>
                                                                    <span class="contact-email info_room_fstatus"></span>
                                                                </div>
                                                                <div class="email-content">
                                                                    <span class="contact-title">สถานะประตู:</span>
                                                                    <span class="contact-email info_room_door"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <!-- <div class="user-send-message">
                                                        <button class="btn btn-info btn-rounded btn-sm" type="button">
                                                            <i class="ti-cloud-down"></i>&nbsp;&nbsp;สำรองข้อมูล</button>
                                                    </div> -->
                                                    <div class="user-send-message">
                                                        <button id='dowload-room-id' class="btn btn-primary btn-rounded btn-sm " type="button">
                                                            <i class="ti-download"></i>&nbsp;&nbsp;ดาวน์โหลดไฟล์ห้อง</button>
                                                    </div>
                                                    <div class="user-send-message">
                                                        <button class="btn btn-sm btn-warning btn-rounded" type="button" data-toggle="modal" data-target="#edit_room">
                                                            <i class="ti-hummer"></i>&nbsp;&nbsp;แก้ไข</button>
                                                    </div>
                                                    <div class="user-send-message">
                                                        <button id='delete-room-id' class="btn btn-danger btn-rounded btn-sm " type="button">
                                                            <i class="ti-alert"></i>&nbsp;&nbsp;ลบห้องนี้</button>
                                                    </div>
                                                    <script>
                                                        // function download_file_room(id_room) {
                                                        //     // alert(id_room);
                                                        //     send_post_get('./controller/con_mg_room.php', {
                                                        //         key: "download_file_room",
                                                        //         id_room: ID_ROOM,
                                                        //     }, 'POST');
                                                        // }
                                                        $("#dowload-room-id").click(function() {
                                                            send_post_get('./controller/con_mg_room.php', {
                                                                key: "download_file_room",
                                                                id_room: ID_ROOM,
                                                            }, 'POST');
                                                        });
                                                        $('#delete-room-id').click(function() {
                                                            swal({
                                                                title: "Are you sure?",
                                                                text: "ต้องการลบห้อง และ ไม่สามารถกู้คืนได้",
                                                                icon: "warning",
                                                                buttons: true,
                                                                dangerMode: true,

                                                            }).then((willDelete) => {
                                                                if (willDelete) {
                                                                    // alert('Are you sure');
                                                                    $.ajax({
                                                                        url: './controller/con_room_search_ad.php',
                                                                        type: 'POST',
                                                                        data: {
                                                                            key: 'delete-room-id',
                                                                            id_room: ID_ROOM
                                                                        },
                                                                        success: function(result, textStatus, jqXHR) {
                                                                            // alert(result);
                                                                            if (result == 'success') {
                                                                                history.back(1);
                                                                            } else {
                                                                                alert(result);
                                                                            }
                                                                        },
                                                                        error: function(jqXHR, textStatus, jqXHR) {

                                                                        }

                                                                    });
                                                                } else {
                                                                    // swal("Your imaginary file is safe!");
                                                                }

                                                            });
                                                        });
                                                    </script>

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
                                                                                <input id='check_edit_room' type="checkbox"> ยืนการแก้ไขข้อมูล
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
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                                                    <div id='div_btn_edit'><button id='btn_edit_room' type="button" class="btn btn-primary">แก้ไขข้อมูลห้อง</button></div>
                                                                </div>

                                                                <script>
                                                                    $('#btn_edit_room').click(function() {
                                                                        // get Value Edit

                                                                        // var id_room = id_room_edit;
                                                                        var room_id_code = $('#edit_input_id_room').val();
                                                                        var room_name = $('#edit_input_room_name').val();
                                                                        var room_dclose = $('#edit_input_room_dclose').val();
                                                                        var room_open = $('#edit_input_room_open').val();

                                                                        // alert(id_room + " " + room_name + " " + room_id_code + " " + room_dclose);


                                                                        // alert(id_room + ' ' + room_name + ' ' + room_dclose);

                                                                        if (room_id_code != '' && room_name != '' && room_dclose != '' && room_open != '') {
                                                                            $.ajax({
                                                                                url: './controller/con_mg_room.php',
                                                                                type: 'POST',
                                                                                data: {
                                                                                    key: 'btn_edit_room',
                                                                                    id_room: ID_ROOM,
                                                                                    room_id_code: room_id_code,
                                                                                    room_name: room_name,
                                                                                    room_dclose: room_dclose,
                                                                                    room_open: room_open

                                                                                },
                                                                                success: function(result, textStatus, jqXHR) {
                                                                                    // alert(result);
                                                                                    if (result == "success") {
                                                                                        swal('แกไขห้องสำเร็จ', {
                                                                                            icon: "success",
                                                                                            buttons: false,
                                                                                            timer: 1000,
                                                                                        });
                                                                                        search_room_info();
                                                                                        $('#edit_room').modal('hide');
                                                                                        $('#btn_edit_room').attr('ata-dismiss', 'modal');
                                                                                        // $('#btn_create_room').attr('ata-dismiss','modal');
                                                                                    } else {
                                                                                        // alert(result);
                                                                                        swal('กรุณาตรวจสอบข้อมูล', {
                                                                                            icon: "warning",
                                                                                            buttons: false,
                                                                                            timer: 1000,
                                                                                        });
                                                                                        search_room_info();
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
                                            <table id="tb_room_el" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>รหัสประจำตัว</th>
                                                        <th>ชื่อบุคลากร</th>
                                                        <th class="text-center">
                                                            <a href="#" data-toggle="modal" data-target="#add_el" data-whatever="@mdo"><i class="ti-plus">&nbsp;เพิ่ม</i></a>
                                                            &nbsp;&nbsp;&nbsp;<i id='checkbox_delet_all' class="ti-close">&nbsp;ลบ</i>
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody id='tbb_room_el'>
                                                </tbody>
                                            </table>
                                            <script>
                                                $("#tb_room_el").on('click', '.click_submit_search', function() {
                                                    // get the current row
                                                    var currentRow = $(this).closest("tr");
                                                    var id_mem = currentRow.find("td:eq(0) input[type='hidden']").val();
                                                    // var id_room = currentRow.find("td:eq(2) input[type='hidden']").val();
                                                    send_post_get('personal_search_ad.php', {
                                                        id: id_mem
                                                    }, 'get');


                                                });

                                                $("#checkbox_delet_all").click(function() {
                                                    // $('input:checkbox').not(this).prop('checked', this.checked);
                                                    // alert("Check");
                                                    var select_delete_array = [];
                                                    $('.select_delete_el').each(function() {
                                                        if ($(this).is(":checked")) {
                                                            select_delete_array.push($(this).val());
                                                        }
                                                    });
                                                    // alert(select_delete_array[0]);

                                                    swal({
                                                        title: "Are you sure?",
                                                        text: "ต้องการลบข้อมูลสิทธิ์ใช้หรือไม่?",
                                                        icon: "warning",
                                                        buttons: true,
                                                        dangerMode: true,
                                                    }).then((willDelete) => {
                                                        if (willDelete) {
                                                            if (select_delete_array.length > 0) {
                                                                $.ajax({
                                                                    url: "./controller/con_admin.php",
                                                                    type: "POST",
                                                                    data: {
                                                                        key: 'select_delete_el',
                                                                        id_eligibilty: select_delete_array

                                                                    },
                                                                    success: function(result, textStatus, jqXHR) {
                                                                        // alert(result);
                                                                        show_tb_room_el();
                                                                        // timemer();
                                                                        swal("ลบ Permission สำเร็จ", {
                                                                            icon: "success",
                                                                            buttons: false,
                                                                            timer: 1000,
                                                                        });

                                                                    },
                                                                    error: function(jqXHR, textStatus, errorThrown) {

                                                                    }
                                                                });
                                                            } else {
                                                                swal("กรุณาเลือกข้อมูล", "", 'warning');
                                                            }
                                                        } else {
                                                            // swal("Your imaginary file is safe!");
                                                        }
                                                    });


                                                });

                                                function sleep(ms) {
                                                    return new Promise(resolve => setTimeout(resolve, ms));
                                                }

                                                async function timemer() {
                                                    swal("ลบ Permission สำเร็จ", {
                                                        icon: "success",
                                                        buttons: false,
                                                        timer: 1000,
                                                    });
                                                    await sleep(2000);
                                                    // location.reload();
                                                    show_tb_room_el();
                                                }

                                                // demo();
                                            </script>


                                            <script>
                                                $(document).ready(function() {
                                                    show_tb_room_el();
                                                    show_tb_room_schedule();
                                                });

                                                // pdfMake.fonts = {
                                                //     THSarabunNew: {
                                                //         normal: './controller/font/THSarabunNew.ttf',
                                                //         bold: './controller/font/THSarabunNew-Bold.ttf',
                                                //         italics: './controller/font/THSarabunNew-Italic.ttf',
                                                //         bolditalics: './controller/font/THSarabunNew-BoldItalic.ttf'
                                                //     }

                                                // }

                                                function show_tb_room_el() {
                                                    var tb_room_el = $('#tb_room_el').DataTable({
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
                                                                return "รายชื่อบุคลากรที่มีสิทธิ์เข้าห้อง " + NAME_ROOM; //+hour+'-'+minutes + '-'+days +'-'+month +'-'+years
                                                            },
                                                            // title: 'รายชื่อสิทเข้าห้อง',
                                                            exportOptions: {
                                                                columns: [0, 1],
                                                                // คอลัมส์ที่จะส่งออก
                                                                modifier: {
                                                                    page: 'all' // หน้าที่จะส่งออก all / current
                                                                },
                                                                stripHtml: true
                                                            }
                                                        }],
                                                        retrieve: true,

                                                    });

                                                    tb_room_el.clear();

                                                    $.ajax({
                                                        url: "./controller/con_room_search_ad.php",
                                                        type: "POST",
                                                        data: {
                                                            key: "show_tb_room_el",
                                                            id_room: ID_ROOM
                                                        },
                                                        success: function(result, textStatus, jqXHR) {
                                                            // alert(result);
                                                            // console.log(result);
                                                            var json = jQuery.parseJSON(result);
                                                            // var i = 0;
                                                            if (json != false) {

                                                                $.each(json, function(key, val) {

                                                                    var col1 = '<input type="hidden" name="id_mem" value="' + val['id_mem'] + '">' + val['id_code'];
                                                                    var col2 = val['name'] + " " + val['last_name'];
                                                                    // var col3 = '<input type="hidden" name="id_room" value="' + val['id_room'] + '">' + val['room_num'];
                                                                    var col3 = '<div class="text-center"><a href="./personal_search_ad.php?id=' + val['id_mem'] + '"class="click_submit_search_clode"><i class="ti-search"></i></a>' +
                                                                        '&nbsp;&nbsp;&nbsp;&nbsp;' +
                                                                        '<input class="select_delete_el" type="checkbox" value="' + val['id_eligibilty'] + '"> </div>';
                                                                    tb_room_el.row.add([
                                                                        col1,
                                                                        col2,
                                                                        col3
                                                                    ]).draw(true);

                                                                    // var col1 = '<input type="hidden" name="id_mem" value="' + val['id_mem'] + '">' + val['id_code'];
                                                                    // var col2 = val['name'] + " " + val['last_name'];
                                                                    // // var col3 = '<input type="hidden" name="id_room" value="' + val['id_room'] + '">' + val['room_num'];
                                                                    // var col4 = '<div class="text-center"><a href="./personal_search_ad.php?id=' + val['id_mem'] + '"class="click_submit_search_clode"><i class="ti-search"></i></a>' +
                                                                    //     '&nbsp;&nbsp;&nbsp;&nbsp;' +
                                                                    //     '<input class="select_delete" type="checkbox" value=\' ' + val['id_eligibilty'] + '\'> </div>';
                                                                    // tb_room_el.row.add([
                                                                    //     col1,
                                                                    //     col2,
                                                                    //     // col3,
                                                                    //     col4
                                                                    // ]).draw(true);
                                                                    // class="click_submit_search"

                                                                });
                                                            } else {

                                                            }
                                                        },
                                                        error: function(xhr, status, error) {
                                                            alert(xhr.statusText + status + error + ': ' + xhr.responseText);
                                                        }
                                                    });

                                                }

                                                // $("#tb_room_el").on('click', '.click_submit_search', function() {
                                                //     // get the current row
                                                //     var currentRow = $(this).closest("tr");
                                                //     var id_mem = currentRow.find("td:eq(0) input[type='hidden']").val();
                                                //     // var id_room = currentRow.find("td:eq(2) input[type='hidden']").val();
                                                //     send_post_get('personal_search_ad.php', {
                                                //         id: id_mem
                                                //     }, 'GET');


                                                // });
                                            </script>

                                        </div>
                                    </div>
                                </div>
                                <!-- /# card -->
                            </div>
                            <!-- /# column -->
                        </div>
                    </section>


                    <div class="modal fade" id="add_el" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มสิทธิ๋เข้าห้อง</h5>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label>เลือกห้อง</label>
                                            <select id="select_id_room" class="form-control">
                                                <option disabled selected>กรุณาเลือก</option>
                                                <?php
                                                $room = Database::query("SELECT * FROM `rooms` WHERE `id_room` = '$id_room'", PDO::FETCH_ASSOC);
                                                foreach ($room as $row) :
                                                ?>
                                                    <option value="<?php echo $row['id_room'] ?>"><?php echo $row['room_num']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>รหัสประจำตัว</label>
                                            <input id="search_id_code" type="text" class="form-control" placeholder="รหัสประจำตัว">
                                        </div>
                                        <div class="form-group ">
                                            <div class="bootstrap-data-table-panel">
                                                <div class="table-responsive">

                                                    <table class="table table-hover" id="tb_select_show_mem">
                                                        <thead>
                                                            <tr>
                                                                <td><input id='check_box_all' type='checkbox'> เลือกทั้งหมด</td>
                                                                <td>รหัสประจำตัว</td>
                                                                <td>ชื่อ</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbb_showmember">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                        <script>
                                            // $('#select_id_room').on('keyup', function() {
                                            //     add_el();
                                            // });
                                            // add_el();
                                            $("#select_id_room").bind("change keyup", function(event) {
                                                //Code here
                                                add_el();
                                            });
                                            $('#search_id_code').on('keyup', function() {
                                                add_el();
                                            });
                                            $("#check_box_all").click(function() {
                                                $('.checkbox_id_code').not(this).prop('checked', this.checked);
                                            });

                                            function add_el() {
                                                // alert('keyup');
                                                var id_room = $('#select_id_room').val();
                                                var id_code = $('#search_id_code').val();
                                                // alert(id_room);
                                                $.ajax({
                                                    url: "./controller/con_admin.php",
                                                    type: "POST",
                                                    data: {
                                                        key: "search_id_code",
                                                        id_code: id_code,
                                                        id_room: id_room == null ? '' : id_room
                                                    },
                                                    success: function(result, textStatus, jqXHR) {
                                                        // console.log(result);
                                                        // alert(result);
                                                        // console.log(result);
                                                        // alert(result);
                                                        var json = jQuery.parseJSON(result);
                                                        if (json != false) {
                                                            // $('#row_check_rqroom').style
                                                            $("#tbb_showmember").empty();
                                                            var name_room = "";
                                                            $.each(json, function(key, val) {
                                                                // i += 1;
                                                                var row = "";
                                                                var tr = "<tr>";
                                                                var _tr = "</tr>";
                                                                var td = "<td>";
                                                                var _td = "</td>";

                                                                row += tr;

                                                                row += td + "<input  type='checkbox' class='checkbox_id_code'  value='" + val['id_mem'] + "'> " + _td;
                                                                row += td + val['id_code'] + _td;
                                                                row += td + val['name'] + " " + val['last_name'] + _td;

                                                                row += _tr;

                                                                $('#tb_select_show_mem > tbody:last').append(row);
                                                            });
                                                        } else {
                                                            $("#tbb_showmember").empty();
                                                            var row = "";
                                                            var tr = "<tr>";
                                                            var _tr = "</tr>";
                                                            var td = "<td>";
                                                            var _td = "</td>";

                                                            row += td + "" + _td;
                                                            row += td + "" + _td;
                                                            row += td + "ไม่มีข้อมูล" + _td;

                                                            $('#tb_select_show_mem  > tbody:last').append(row);
                                                        }

                                                    },
                                                    error: function(jqXHR, textStatus, errorThrown) {
                                                        alert(errorThrown);
                                                    }
                                                });

                                            }
                                        </script>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button id="btn_cancel_permission" type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                    <button id='add_permission' type="button" class="btn btn-primary">เพิ่มสิทธิ์เข้าห้อง</button>
                                    <script>
                                        $('#btn_cancel_permission').on('click', function() {
                                            // location.reload();
                                            show_tb_room_el();
                                        });

                                        $('#add_permission').on('click', function() {
                                            // alert('Permission : ' + $('.checkbox_id_code').val());
                                            var id_code_array = [];
                                            var id_room = $('#select_id_room').val();
                                            $('.checkbox_id_code').each(function() {
                                                if ($(this).is(":checked")) {
                                                    id_code_array.push($(this).val());
                                                }
                                            });

                                            if (id_code_array.length > 0) {
                                                $.ajax({
                                                    url: "./controller/con_admin.php",
                                                    type: "POST",
                                                    data: {
                                                        key: "add_permission",
                                                        id_mem: id_code_array,
                                                        id_room: id_room
                                                    },
                                                    success: function(result, textStatus, jqXHR) {
                                                        // alert(result);
                                                        // $('#add_permission').attr("data-dismiss", "modal");

                                                        swal("เพิ่ม Permission สำเร็จ", {
                                                            icon: "success",
                                                            buttons: false,
                                                            timer: 1000,
                                                        });
                                                        add_el();
                                                        show_tb_room_el();
                                                    },
                                                    error: function(jqXHR, textStatus, errorThrown) {}
                                                });
                                            } else {
                                                swal("กรุณาเลือก Permission", {
                                                    icon: "warning",
                                                    buttons: false,
                                                    timer: 1000,
                                                });
                                            }


                                            // $('#add_el').modal('close');
                                            // alert(languages[0])

                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <table id="tb_room_schedule" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>รหัสประจำตัว</th>
                                                        <th>ชื่อบุคลากร</th>
                                                        <th>เวลา เข้า</th>
                                                        <th class="text-center">รายละเอียด</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- <tr>
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
                                                    </tr> -->
                                                </tbody>
                                            </table>
                                            <script>
                                                function show_tb_room_schedule() {
                                                    var tb_room_el = $('#tb_room_schedule').DataTable({
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
                                                        // ajax: function(){

                                                        // },

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
                                                                return "ประวัติการเข้าห้อง " + NAME_ROOM; //+hour+'-'+minutes + '-'+days +'-'+month +'-'+years
                                                            },
                                                            // title: 'รายชื่อสิทเข้าห้อง',
                                                            exportOptions: {
                                                                columns: [0, 1, 2],
                                                                // คอลัมส์ที่จะส่งออก
                                                                modifier: {
                                                                    page: 'all' // หน้าที่จะส่งออก all / current
                                                                },
                                                                stripHtml: true
                                                            }
                                                        }],
                                                        retrieve: true,

                                                    });

                                                    tb_room_el.clear();

                                                    $.ajax({
                                                        url: './controller/con_room_search_ad.php',
                                                        type: 'POST',
                                                        data: {
                                                            key: 'show_tb_room_schedule',
                                                            id_room: ID_ROOM

                                                        },
                                                        success: function(result, textStatus, jqXHR) {
                                                            // alert(result);
                                                            var json = JSON.parse(result);
                                                            $.each(json, function(key, val) {
                                                                // var id_code = val.id_code;
                                                                var col1 = val['id_code'];
                                                                var col2 = val['full_name'];
                                                                var col3 = val['time_stamp'];
                                                                tb_room_el.row.add([
                                                                    col1,
                                                                    col2,
                                                                    col3,
                                                                    '<div class="text-center"><a href="./personal_search_ad.php?id=' + val['id_mem'] + '"><i class="ti-search"></i></a></div>'
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
                                <!-- /# card -->
                            </div>
                            <!-- /# column -->
                        </div>
                        <!-- /# row -->
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




    <script src="../../script/assets/js/lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="../../script/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.flash.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/vfs_fonts.js"></script>
    <!-- <script src="../../script/vfs_fonts.js"></script> -->
    <script src="../../script/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.print.min.js"></script>

    <!-- <script src="cdn.datatables.net/plug-ins/1.11.3/i18n/th.json"></script> -->

</body>

</html>