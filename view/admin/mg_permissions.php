<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar_ad.php");

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
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./mg_permissions.php">Management Room</a></li>
                                    <li class="breadcrumb-item active">จัดการสิทธิ์บุคลากร</li>
                                </ol>
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
                                        <!-- id="row-select" class="display table table-borderd table-hover table-striped " -->
                                        <table class="table table-hover" id="tb_showeligibility">
                                            <thead>
                                                <tr>
                                                    <th>รหัสประจำตัว</th>
                                                    <th>ชื่อ - สกุล</th>
                                                    <th>ห้องที่มีสิทธิ์เข้า</th>
                                                    <th class="text-center">
                                                        <a href="#" data-toggle="modal" data-target="#add_room" data-whatever="@mdo"><i class="ti-plus">&nbsp;เพิ่ม</i></a>
                                                        &nbsp;&nbsp;&nbsp;<i id='checkbox_delet_all' class="ti-close">&nbsp;ลบ</i>
                                                    </th>

                                                </tr>
                                            </thead>

                                            <tbody id="tbb_showeligibility">
                                                <?php
                                                $shom_el = Database::query("SELECT mm.id_mem,rm.id_room, el.id_eligibilty,mm.id_code,mm.name,mm.last_name,mm.position,rm.room_num FROM `eligibility` as el INNER JOIN members as mm ON el.id_mem = mm.id_mem INNER JOIN rooms as rm ON el.id_room = rm.id_room;", PDO::FETCH_ASSOC);
                                                foreach ($shom_el as $room) :
                                                ?>
                                                    <tr>

                                                        <td><input type="hidden" name="id_mem" value="<?php echo $room['id_mem'] ?>"><?php echo $room['id_code']; ?></td>
                                                        <td><?php echo $room['name'] . " " . $room['last_name']; ?></td>
                                                        <td><input type="hidden" name="id_room" value="<?php echo $room['id_room'] ?>"><?php echo $room['room_num'] ?></td>
                                                        <th class="text-center">
                                                            
                                                            <a class='click_submit_search'><i class="ti-search"></i></a>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;<input class="select_delete" type='checkbox' value='<?php echo $room['id_eligibilty'] ?>'>
                                                        </th>
                                                    </tr>
                                                <?php
                                                endforeach;
                                                ?>
                                            </tbody>
                                            <script>
        
                                                $("#tb_showeligibility").on('click', '.click_submit_search', function() {
                                                    // get the current row
                                                    var currentRow = $(this).closest("tr");
                                                    var id_mem = currentRow.find("td:eq(0) input[type='hidden']").val();
                                                    // var id_room = currentRow.find("td:eq(2) input[type='hidden']").val();
                                                    send_post_get('personal_search_ad.php',{id:id_mem },'get');


                                                });

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



                                                $("#checkbox_delet_all").click(function() {
                                                    // $('input:checkbox').not(this).prop('checked', this.checked);
                                                    // alert("Check");
                                                    var select_delete_array = [];
                                                    $('.select_delete').each(function() {
                                                        if ($(this).is(":checked")) {
                                                            select_delete_array.push($(this).val());
                                                        }
                                                    });
                                                    // alert(select_delete_array.length)

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
                                                                        timemer();

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
                                                        // timer: 1000,
                                                    });
                                                    await sleep(2000);
                                                    location.reload();
                                                }

                                                // demo();
                                            </script>
                                        </table>
                                        <!-- <script>
                                            window.onload = function() {
                                                // show_tb_eligibility();
                                            };
                                            setInterval(function() {

                                            }, 5000); // 1000 = 1 second

                                            function show_tb_eligibility() {
                                                // alert('Eligibility');
                                                $.ajax({
                                                    url: "./controller/con_admin.php",
                                                    type: "POST",
                                                    data: {
                                                        key: "show_tb_eligibility"
                                                    },
                                                    success: function(result, textStatus, jqXHR) {
                                                        // alert(result);
                                                        console.log(result);
                                                        var json = jQuery.parseJSON(result);
                                                        // var i = 0;
                                                        if (json != false) {

                                                            $("#tbb_showeligibility").empty();

                                                            $.each(json, function(key, val) {
                                                                var row = "";
                                                                var tr = "<tr>";
                                                                var _tr = "</tr>";
                                                                var td = "<td>";
                                                                var _td = "</td>";


                                                                row += tr;
                                                                row += td + 1 + _td;
                                                                row += td + 2 + _td;
                                                                row += td + 3 + _td;
                                                                row += td + 4 + _td;
                                                                row += _tr;

                                                                $('#tb_showeligibility > tbody:last').append(row);
                                                            });
                                                        } else {
                                                            $("#tbb_showeligibility").empty();
                                                            var row = "";
                                                            var tr = "<tr>";
                                                            var _tr = "</tr>";
                                                            var td = "<td>";
                                                            var _td = "</td>";

                                                            row += tr;
                                                            row += td + "" + _td;
                                                            row += td + "ยังไม่มีข้อมูลห้อง" + _td;
                                                            row += _tr;

                                                            $('#tb_showeligibility  > tbody:last').append(row);
                                                        }
                                                    }
                                                }).error(function(xhr, status, error) {
                                                    alert(xhr.statusText + status + error + ': ' + xhr.responseText);
                                                });
                                            }
                                        </script> -->
                                    </div>
                                </div>

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
                                                        <label>รหัสประจำตัว</label>
                                                        <input type="text" class="form-control" value="1339900662224" readonly="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>เลือกห้อง</label>
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
                                                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.confirm('ยืนยันการลบสิทออกจากห้อง !')">Delete</button>
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
                                                    <label>เลือกห้อง</label>
                                                    <select id="select_id_room" class="form-control">
                                                        <option disabled selected>กรุณาเลือก</option>
                                                        <?php
                                                        $room = Database::query("SELECT * FROM `rooms`", PDO::FETCH_ASSOC);
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
                                                    $("#select_id_room").bind("change keyup", function(event) {
                                                        //Code here
                                                        add_el();
                                                    });
                                                    $('#search_id_code').on('keyup', function() {
                                                        add_el();
                                                    });
                                                    $("#check_box_all").click(function() {
                                                        $('input:checkbox').not(this).prop('checked', this.checked);
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
                                                                console.log(result);
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
                                            <button id="btn_cancel_permission" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button id='add_permission' type="button" class="btn btn-primary">ADD Permissions</button>
                                            <script>
                                                $('#btn_cancel_permission').on('click', function() {
                                                    location.reload();
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

                                                    // $('#add_room').modal('close');
                                                    // alert(languages[0])
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
                                                            // $('#add_permission').attr("data-dismiss", "modal");
                                                            // location.reload();

                                                            // .then((willDelete) => {
                                                            //     if (willDelete) {
                                                            //         // alert("result");
                                                            //     }else{
                                                            //         // alert("error");
                                                            //         location.reload();
                                                            //     }
                                                            // });

                                                            // $('#add_permission').attr("data-dismiss", "modal");
                                                        },
                                                        error: function(jqXHR, textStatus, errorThrown) {}
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </section>
        </div>
    </div>
    <!-- <script src="../../script/assets/js/lib/data-table/datatables.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.flash.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../../script/assets/js/lib/data-table/datatables-init.js"></script> -->

    <!-- scripit init-->
    <script src="../../script/assets/js/lib/data-table/datatables.min.js"></script>
    <!-- <script src="../../script/assets/js/lib/data-table/dataTables.buttons.min.js"></script> -->
    <!-- <script src="../../script/assets/js/lib/data-table/buttons.flash.min.js"></script> -->
    <!-- <script src="../../script/assets/js/lib/data-table/jszip.min.js"></script> -->
    <!-- <script src="../../script/assets/js/lib/data-table/pdfmake.min.js"></script> -->
    <!-- <script src="../../script/assets/js/lib/data-table/vfs_fonts.js"></script> -->
    <script src="../../script/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <!-- <script src="../../script/assets/js/lib/data-table/buttons.print.min.js"></script> -->
    <script src="../../script/assets/js/lib/data-table/datatables-init.js"></script>

    <script>
        $(document).ready(function() {
            $('#tb_showeligibility').DataTable();
            // $('#tb_select_show_mem').DataTable();

        });
    </script>
    <script src="../../script/assets/js/lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.js"></script>


</body>

</html>