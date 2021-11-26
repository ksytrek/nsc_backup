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
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(255, 255, 255, .8) url('http://i.stack.imgur.com/FhHRx.gif') 50% 50% no-repeat;
        }
        body.loading .modal {
            overflow: hidden;
        }

        body.loading .modal {
            display: block;
        }
    </style>
</head>

<body>
    <div class="modal">
        <!-- Place at bottom of page -->
    </div>
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
                                    <li class="breadcrumb-item"><a href="#">Train Model</a></li>
                                    <li class="breadcrumb-item active">ฝึกโมเดล</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>Train Model</h4>

                            </div>
                            <div class="card-toggle-body">
                                <p class="text-muted m-b-15">
                                    รายละเอียดควรรู้ก่อน Train 
                                    <h5>กรุณาอย่าปิด บราวเซอร์ จนกว่าระบบทำงานเสร็จ</h5>
                                    <code> Run Script Python Train</code>
                                </p>
                                <!-- <form active="./train_model.php" method="post"> -->
                                <button name="btn-train" id="btn-train" type="button" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-pie-chart"></i>Start Train Model</button>
                                <!-- </form> -->
                                <script>
                                    var body = $("body");
                                    $('#btn-train').click(function() {
                                        if (window.confirm('คุณต้องการ Train Model ?...')) {
                                            $.ajax({
                                                url: './controller/com_train_model.php',
                                                type: 'POST',
                                                data: {
                                                    key: 'btn-train'
                                                },
                                                cache: false,
                                                beforeSend: function() {
                                                    console.log(result);
                                                    body.addClass("loading");
                                                },
                                                complete: function() {
                                                    // body.addClass("loading");
                                                },
                                                success: function(result, textStatus, jqXHR) {
                                                    body.removeClass("loading");
                                                    $('#code_show_').html(result)
                                                },
                                                error: function(jqXHR, textStatus, errorThrown) {
                                                    // body.addClass("loading");
                                                }
                                            });
                                        }
                                    });
                                    // body.removeClass("loading");
                                    // $(document).on({
                                    //     ajaxStart: function() {
                                    //         body.addClass("loading");
                                    //     },
                                    //     ajaxStop: function() {
                                    //         body.removeClass("loading");
                                    //     }
                                    // });
                                </script>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>Terminal run</h4>

                            </div>
                            <div class="col-lg-12" style="background-color: black;">
                                <code id="code_show_">
                                </code>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

</body>

</html>