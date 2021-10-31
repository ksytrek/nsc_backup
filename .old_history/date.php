<?php require_once('./Model/ConnectDB.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="bt/css/bootstrap.min.css" rel="stylesheet">
    <link href="bt/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js">
    </script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />



    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "aaSorting": [
                    [0, 'ASC']
                ],
            });
        });
    </script>
</head>

<body>

    <br>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading"><b>
                            <font size="5">
                                <center> ค้นหา ตามช่วงวันที่</center>
                            </font>
                        </b></div>
                    <div class="panel-body">
                        <form id="form1" name="form1" class="form-inline" method="post" >
                            <center>
                                <div class="form-group">
                                    <label for="exampleInputName2">วันที่ :</label>
                                    <input name="d_s" id="datepicker" width="270" />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail2">&nbsp;ถึงวันที่ :&nbsp;</label>
                                    <input name="d_e" id="datepicker2" width="270" />
                                </div>
                                &nbsp;&nbsp;<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> ค้นหา</button>
                            </center>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap',
            format: "yyyy-mm-dd",
            type: "date"
        });
    </script>

    <script>
        $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap',
            format: "yyyy-mm-dd",
            type: "date"
        });
    </script>

    <div class="container">

        <table border="0" align="center" cellspacing="1" class="display" id="example">
            <!--ส่วนหัว-->
            <thead>
                <tr>
                    <th align="center">ลำดับ</th>
                    <th align="center">รหัสนักศึกษา</th>
                    <th align="center">ห้อง</th>
                    <th align="center">วันที่</th>
                </tr>
            </thead>
            <?php
            $num = 1;
            $d_s = $_POST['d_s']; //ตัวแปรวันที่เริ่มต้น
            $d_e = $_POST['d_e']; //ตัวแปรวันที่สิ้นสุด

            $d_s = $d_s . " " . '00.00.00'; //กำหนดเวลาเริ่มต้น

            $d_e = $d_e . " " . '23.59.59'; //กำหนดเวลาสิ้นสุด

            echo $d_s;
            echo "<br>";
            echo $d_e;
            echo "<br>";


            $query = "SELECT schedule.std_code , rooms.room_num , schedule.time_stamp FROM schedule INNER JOIN rooms ON schedule.room_code = rooms.room_code  WHERE time_stamp BETWEEN '2020-01-01' AND '2020-12-31'";
            //ประกาศตัวแปร sqli
            // $result = mysqli_query($condb, $query); //ดูชื่อ ตัวแปรในไฟล์ connect ให้ดีว่า conหรือ condb หรืออย่างอื่น
            $result = $connectDB->prepare($query);
            $result->execute();
            $num2 = $result->rowCount();

            // echo "66666666666";
            // echo $num2."66666666666";
            //สร้างตัวแปร $row มารับค่าจากการ fetch array


            //วนลูป
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {  ?>

                <tr>
                    <td><?php echo $num++; ?>
                    </td>
                    <td><?php echo $row['std_code']; ?></td>
                    <td><?php echo $row['room_num']; ?></td>
                    <td><?php echo $row['time_stamp']; ?></td>

                </tr>
            <?php }
                $connectDB = null;// mysqli_close($condb); //ดูชื่อ ตัวแปรในไฟล์ connect ให้ดีว่า conหรือ condb หรืออย่างอื่น
            ?>
        </table>
    </div>
</body>

</html>