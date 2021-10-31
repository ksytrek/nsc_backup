<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Event Registration Form</h2>
                </div>
                <div class="card-body">
                    <form action="../../Controller/Controller_Click.php" method="POST">
                        <div class="form-row">
                            <div class="name">ตำเเหน่ง</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="position" onchange="show_change(this.value)" required>
                                            <option value="" disabled selected='selected'>กรุณาเลือก</option>
                                            <option value="student">นักศึกษา</option>
                                            <option value="professor">อาจารย์</option>
                                            <option value="other">อื่น ๆ</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- เริ่มเลื่อก -->
                        <div id="student" class="form-row">
                            <div class="name">เลขประจำตัวนักศึกษา</div>
                            <div class="value">
                                <div class="input-group">
                                    <input id="id_student" class="input--style-5" type="text" name="id_student">
                                </div>
                            </div>
                        </div>
                        <div id="professor" class="form-row" style="display:none;">
                            <div class="name">เลขประจำตัว</div>
                            <div class="value">
                                <div class="input-group">
                                    <input id="id_professor" class="input--style-5" type="text" name="id_professor">
                                </div>
                            </div>
                        </div>
                        <div id="other" class="form-row" style="display:none;">
                            <div class="name">เลขบัตรประชาชน</div>
                            <div class="value">
                                <div class="input-group">
                                    <input id="id_other" class="input--style-5" type="text" name="id_other">
                                </div>
                            </div>
                        </div>
                        <!-- ปิดเลือก -->
                        <script>
                            function show_change(text) {
                                if (text == "student") {
                                    document.getElementById("student").style.display = "";
                                    document.getElementById("id_student").value = "";
                                    document.getElementById("id_student").setAttribute('required', 'true');

                                    document.getElementById("professor").style.display = "none";
                                    document.getElementById("id_professor").value = "";
                                    document.getElementById("id_professor").removeAttribute('required');

                                    document.getElementById("other").style.display = "none";
                                    document.getElementById("id_other").value = "";
                                    document.getElementById("id_other").removeAttribute('required');


                                } else if (text == "professor") {
                                    document.getElementById("student").style.display = "none";
                                    document.getElementById("id_student").value = "";
                                    document.getElementById("id_student").removeAttribute('required');


                                    document.getElementById("professor").style.display = "";
                                    document.getElementById("id_professor").value = "";
                                    document.getElementById("id_professor").setAttribute('required', 'true');


                                    document.getElementById("other").style.display = "none";
                                    document.getElementById("id_other").value = "";
                                    document.getElementById("id_other").removeAttribute('required');


                                } else if (text == "other") {
                                    document.getElementById("student").style.display = "none";
                                    document.getElementById("id_student").value = "";
                                    document.getElementById("id_student").removeAttribute('required');

                                    document.getElementById("professor").style.display = "none";
                                    document.getElementById("id_professor").value = "";
                                    document.getElementById("id_professor").removeAttribute('required');

                                    document.getElementById("other").style.display = "";
                                    document.getElementById("id_other").value = "";
                                    document.getElementById("id_other").setAttribute('required', 'true');

                                }
                            }
                        </script>
                        <div class="form-row m-b-55">
                            <div class="name">ชื่อ</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="first_name" required>
                                            <label class="label--desc">first name</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="last_name" required>
                                            <label class="label--desc">last name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">รหัสผ่าน</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="password" name="pass_regis" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row m-b-55">
                            <div class="name">Phone</div>
                            <div class="value">
                                <div class="row row-refine">
                                    <div class="col-3">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="area_code" value="+66" disabled='disabled'>
                                            <label class="label--desc">Area Code</label>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="phone" required>
                                            <label class="label--desc">Phone Number</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-3">
                                <div class="input-group-desc">
                                    <button name="btn_register_submit" class=" btn btn--radius-2 btn--green" type="submit" onclick="return confirm('ยืนยันการสมัครสมาชิก!!!!')" >Register</button>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group-desc">
                                    <button name="btn_register_cancel" class="btn btn--radius-2 btn--red" type="button" onclick="confirm('ยืนยันการยกเลิก ?') ; window.location.href='../Main_Login/'">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->