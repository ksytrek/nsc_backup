<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar_ad.php");
$id_mem = $_GET["id"];
$row_mm = Database::query("SELECT * FROM members WHERE `id_mem`= {$id_mem};", PDO::FETCH_ASSOC)->fetch();

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Face Admin Dashboard</title>


</head>
<script>
    const ID_MEM = '<?php echo $id_mem; ?>';
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
                                    <li class="breadcrumb-item"><a href="#">Management</a></li>
                                    <li class="breadcrumb-item active">ตรวจสอบภาพ</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">

                    <div class="row">
                        <div class="col-lg-6">

                            <div class="card-title">
                                <h4>แสดงรูปภาพใบหน้าของคุณ <?php echo $row_mm['name'] . " " . $row_mm['last_name'] ?></h4>
                            </div>

                        </div>
                        <div class="col-lg-6 ">
                            <div class="user-send-message">
                                <?php if ($row_mm['stu_face'] == '0') : ?>
                                    <div class="card-title float-right">
                                        <button id='btn_save_face_person' type="button" class="btn  btn-warning btn-rounded btn-sm">ยังไม่ได้บันทึกภาพใบหน้า</button>
                                    </div>
                                    <script>
                                        $('#btn_save_face_person').click(function() {
                                            if (confirm("คุณสามารถบันทึกได้เพียงครั้งเดี่ยว")) {
                                                location.assign("./on_save_face.php?id=<?php echo $id_mem; ?>");
                                            } else {
                                                // alert("cancel");
                                            }
                                        });
                                    </script>
                                <?php
                                else :
                                ?>
                                    <div class="card-title float-right">
                                        <button id="backup_img_person" name="backup" class="btn btn-info btn-rounded btn-sm" type="button">
                                            <i class="ti-cloud-down"></i>&nbsp;&nbsp;สำรองข้อมูล</button>
                                        <button id='delete_image_select' type="button" class="btn  btn-warning btn-rounded btn-sm">ลบรูปภาพที่เลือก</button>
                                        <button id='delete_image_all' type="button" class="btn  btn-danger btn-rounded btn-sm">ลบรูปภาพทั้งหมด</button>
                                        <script>
                                            $('#delete_image_select').click(function() {
                                                // window.confirm('ลบข้อมูลรูปภาพอย่างถาวร จะไม่สารถกู้คืนได้ !!!')"
                                                var select_delete_array = [];
                                                $('.select_delete_image').each(function() {
                                                    if ($(this).is(":checked")) {
                                                        select_delete_array.push($(this).val());
                                                    }
                                                });
                                                // alert(select_delete_array[0]);

                                                swal({
                                                    title: "Are you sure?",
                                                    text: "ต้องการลบข้อมูลที่เลือกใช้หรือไม่?",
                                                    icon: "warning",
                                                    buttons: true,
                                                    dangerMode: true,
                                                }).then((willDelete) => {
                                                    if (willDelete) {
                                                        if (select_delete_array.length > 0) {
                                                            $.ajax({
                                                                url: "./controller/con_image_search_ad.php",
                                                                type: "POST",
                                                                data: {
                                                                    key: 'select_delete_image',
                                                                    id_tbimage: select_delete_array,
                                                                    id_mem: ID_MEM

                                                                },
                                                                success: function(result, textStatus, jqXHR) {
                                                                    // alert(result);
                                                                    // $('#div_show_tb_image').remove();
                                                                    // $('#div_show_tb_image').empty();
                                                                    // update_show_image();

                                                                    // swal("ลบ Image สำเร็จ", {
                                                                    //     icon: "success",
                                                                    //     buttons: false,
                                                                    //     timer: 1000
                                                                    // });
                                                                    // $('#div_show_tb_image').remove();

                                                                    // update_show_image();

                                                                    timemer();

                                                                },
                                                                error: function(jqXHR, textStatus, errorThrown) {

                                                                }
                                                            });
                                                        } else {
                                                            swal("กรุณาเลือกข้อมูลภาพ", "", 'warning');
                                                        }
                                                    } else {
                                                        // swal("Your imaginary file is safe!");
                                                    }
                                                });
                                            });

                                            $('#delete_image_all').click(function() {
                                                swal({
                                                    title: "Are you sure?",
                                                    text: "ต้องการลบข้อมูลที่เลือกใช้หรือไม่?",
                                                    icon: "warning",
                                                    buttons: true,
                                                    dangerMode: true,
                                                }).then((willDelete) => {
                                                    if (willDelete) {
                                                        $.ajax({
                                                            url: "./controller/con_image_search_ad.php",
                                                            type: "POST",
                                                            data: {
                                                                key: 'select_delete_all',
                                                                id_mem: ID_MEM
                                                            },
                                                            success: function(result, textStatus, jqXHR) {
                                                                // swal("ลบ Image สำเร็จ", {
                                                                //     icon: "success",
                                                                //     buttons: false,
                                                                //     timer: 1000
                                                                // });
                                                                // $('#div_show_tb_image').remove();
                                                                // $('#div_show_tb_image').empty();
                                                                // $('#div_show_tb_image').remove();

                                                                // alert(result);
                                                                timemer();

                                                            },
                                                            error: function(jqXHR, textStatus, errorThrown) {

                                                            }
                                                        });

                                                    } else {
                                                        // swal("Your imaginary file is safe!");
                                                    }
                                                });
                                            });

                                            function sleep(ms) {
                                                return new Promise(resolve => setTimeout(resolve, ms));
                                            }

                                            async function timemer() {
                                                swal("ลบ Image สำเร็จ", {
                                                    icon: "success",
                                                    buttons: false,
                                                    // timer: 1000,
                                                });
                                                await sleep(2000);
                                                location.reload();
                                            }
                                        </script>
                                    </div>
                                    <!-- <div class="card-title float-right"> -->

                                    <script>
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
                                        $('#backup_img_person').click(function() {
                                            send_post_get('./controller/con_image_search_ad.php', {
                                                key: "backup_img_person",
                                                id_mem: ID_MEM,
                                            }, 'POST');
                                            // $.ajax({
                                            //     url: 'https://127.0.0.1/nsc_backup/file_image/1339900662224.zip',
                                            //     method: 'GET',
                                            //     xhrFields: {
                                            //         responseType: 'blob'
                                            //     },
                                            //     success: function(data) {
                                            //         var a = document.createElement('a');
                                            //         var url = window.URL.createObjectURL(data);
                                            //         a.href = url;
                                            //         a.download = '1339900662224.zip';
                                            //         document.body.append(a);
                                            //         a.click();
                                            //         a.remove();
                                            //         window.URL.revokeObjectURL(url);
                                            //     }
                                            // });
                                            // $.ajax({
                                            //     url: "./controller/con_image_search_ad.php",
                                            //     type: "POST",
                                            //     data: {
                                            //         key: "backup_img_person",
                                            //         id_mem:  ID_MEM
                                            //     },
                                            //     success: function(result, textStatus,jqXHR){
                                            //         alert(result);
                                            //     },
                                            //     error: function(jqXHR, textStatus, errorThrown){
                                            //         alert(errorThrown);
                                            //     }
                                            // });
                                        });
                                    </script>

                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <style>
                            input[type=checkbox] {

                                -ms-transform: scale(1.5);
                                -moz-transform: scale(1.5);
                                -webkit-transform: scale(1.5);
                                -o-transform: scale(1.5);
                                transform: scale(1.5);
                                padding: 10px;
                                margin-left: 10px;
                                margin-top: 20px;
                            }


                            label {
                                font-size: 105%;
                            }

                            .img_face {
                                border-radius: 10px;
                                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.5);
                            }
                        </style>

                        <?php
                        // if ($row_mm['stu_face'] == '1') :
                        //     foreach (Database::query("SELECT * FROM `tbimage` INNER JOIN `members` ON tbimage.id_mem = members.id_mem WHERE tbimage.id_mem = {$id_mem};", PDO::FETCH_ASSOC) as $row) :                            
                        ?>
                        <div id='div_show_tb_image'>
                        </div>
                        <?php
                        //     endforeach;
                        // endif;
                        ?>
                        <script>
                            $(document).ready(function() {
                                update_show_image();
                            });

                            function update_show_image() {
                                // var div_show_tb_image = $('#div_show_tb_image').removeAfter();
                                // alert('Please');

                                // $('#div_show_tb_image').empty();
                                // $('#div_show_tb_image').remove();

                                $.ajax({
                                    url: "./controller/con_image_search_ad.php",
                                    type: "POST",
                                    data: {
                                        key: 'update_show_image',
                                        id_mem: ID_MEM
                                    },
                                    success: function(result, textStatus, jqXHR) {
                                        // alert(result);


                                        var json = jQuery.parseJSON(result);
                                        var div_show_tb_image = $('#div_show_tb_image');
                                        $.each(json, function(key, val) {

                                            div_show_tb_image.after(
                                                '<div class="col-lg-3">' +
                                                '<label><img class="img_face"  width="100%" alt="" src="' + '../../' + val['path_image'] + val['name_image'] + '" />' +
                                                '<input type="checkbox" class="select_delete_image " value="' + val["id_tbimage"] + '">&nbsp;&nbsp;&nbsp;เลือกรูปที่ต้องการลบ</label> ' +
                                                '</div>');
                                        });
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {

                                    }
                                });
                                // div_show_tb_image.remove();

                            }
                        </script>

                    </div>
            </div>
        </div>
    </div>


</body>

</html>