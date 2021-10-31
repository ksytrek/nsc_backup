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
                                    รายละเอียดควรรู้ก่อน Train <code> Run Script Python Train</code>
                                </p>
                                <form active="./train_model.php" method="post">
                                    <button name="btn-train" onclick="window.confirm('คุณต้องการ Train Model ?...')"  id="btn-train" type="submit" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-pie-chart"></i>Start Train Model</button>

                                </form>


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
                                <code>
                                    <script>
                                        
                                    </script>
                                    <?php
                                    #!/usr/bin/env python

                                    if(isset($_POST['btn-train'])){
                                        // ob_start();
                                        $handle = popen('python -u ./test_python/test.py', 'r');
                                        while (!feof($handle)) {
                                            echo fgets($handle);
                                            echo "<br>";
                                            flush();
                                            ob_flush();
                                        }
                                        pclose($handle);
                                        echo 
                                        '<script type="text/JavaScript">
                                            window.confirm("Train Model success!!!");
                                            window.location.assign("./train_back.php")
                                        </script>';
                                        // header("location: ./train_back.php");
                                        // header("location: train_back.php" );
                                    //    echo "window.location.href='./train_back.php'";
                                    }

                                   

                                    ?>


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