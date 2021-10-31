<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar.php");
$id_men = "38";
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Face Admin Dashboard</title>

    <link href="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                                    <li class="breadcrumb-item"><a href="./on_face_name.php">Management</a></li>
                                    <li class="breadcrumb-item active">Save Face</li>
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
                                    <h4>ร้องขอใช้ห้อง</h4>
                                </div>
                                <div>
                                </div>
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table table-hover table-striped" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ชื่อห้อง</th>
                                                    <th>เพิ่มคำร้องขอ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $rq_room = Database::query("SELECT * FROM `rooms`   ORDER BY room_num ASC ", PDO::FETCH_ASSOC);
                                                $i = 0;
                                                // while ($row = $rq_room->fetch(PDO::FETCH_ASSOC)) {
                                                foreach ($rq_room  as $row) {
                                                    $i++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $row['room_num'] ?></td>
                                                        <td><a id="add-rq-room" href="#" onclick="add_rq_room(<?php echo $id_mem ?>,<?php echo $row['id_room'] ?>)"><i class="ti-star">&nbsp;&nbsp;เพิม</i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                                <script>
                                                    function add_rq_room(id, id_room) {
                                                        swal({
                                                                title: "ต้องการใช้ห้องนี้หรือไม่",
                                                                text: "กด OK เพื่อยืนยัน กด Cancel เพื่อยกเลิก",
                                                                icon: "info",
                                                                buttons: true,
                                                                dangerMode: true,
                                                            })
                                                            .then((willDelete) => {
                                                                if (willDelete) {
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        data: {
                                                                            key: "add_rq_room",
                                                                            id_mem: id,
                                                                            id_room: id_room
                                                                        },
                                                                        url: "./controller/con_per.php",
                                                                        success: function(result, textStatus, jqXHR) {
                                                                            if(result == "success") {
                                                                                // alert(result);
                                                                                swal("ข้อใช้ห้องสำเร็จ","กรุณารอผู้ดูแลระบบยืนยัน!!", "success");
                                                                            }else if (result == "er_1") {
                                                                                // "ไม่สามารถร้องขอใช้ห้องได้ เพราะมีสิทธิ์เข้าห้องแล้ว"
                                                                                swal("ไม่สามารถร้องขอใช้ห้องได้","เพราะมีสิทธิ์เข้าห้องแล้ว!!", "error");
                                                                            }else if (result == "er_2") {
                                                                                // "ไม่สามารถร้องขอใช้ห้องได้ เพราะกำลังอยู่ในช่วงพิจารณา";
                                                                                swal("ไม่สามารถร้องขอใช้ห้องได้"," เพราะกำลังอยู่ในช่วงพิจารณา!!", "error");
                                                                                // swal("Good job!", "You clicked the button!", "error");
                                                                            }else if (result == "er_3") {
                                                                                // alert("เกิดข้อผิดพลาดโดยไม่ทราบสาเหตุ!");
                                                                                swal("เกิดข้อผิดพลาดโดยไม่ทราบสาเหตุ!!", "error");
                                                                            }else{
                                                                                swal("เกิดข้อผิดพลาดรายแรง!!", "error");
                                                                                // alert("เกิดข้อผิดพลาดโดยไม่ทราบสาเหตุ!");
                                                                            }
                                                                        },
                                                                        error: function() {
                                                                            swal("เกิดข้อผิดพลาดรายแรง!!", "โปรแจ้ง Admin เพื่อทำการแก้ไข", "error");
                                                                        }
                                                                    });
                                                                } else {
                                                                    // swal("Your imaginary file is safe!");
                                                                }
                                                            });
                                                    }
                                                </script>
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


                    <?php
                    // include_once("./report_dasboard_ad.php")
                    ?>

                </section>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    <script src="../../script/assets/js/lib/datatables/jquery.dataTables.min.js"></script>
    <script src="../../script/assets/js/lib/datatables/dataTables.bootstrap4.min.js"></script>



</body>

</html>