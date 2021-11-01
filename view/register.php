<!DOCTYPE html>
<html lang="en">

<?php
include('../config/connectdb.php');
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Focus Admin: Widget</title>

    <!-- Styles -->
    <link href="../script/assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../script/assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../script/assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../script/assets/css/lib/helper.css" rel="stylesheet">
    <link href="../script/assets/css/style.css" rel="stylesheet">
    <link href="../script/assets/css/lib/sweetalert/sweetalert.css" rel="stylesheet">

</head>

<body class="bg-primary">
    <script>
        var accuracy_id = "";
        var accuracy_name = "";
        var accuracy_lastname = "";
        var accuracy_mail = "";
        var accuracy_phone = "";
        var accuracy_pass = "";
        var accuracy_position = "";
        
    </script>
    <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="./login.php"><span></span></a>
                        </div>
                        <div class="login-form">
                            <h4>Register to Personnel</h4>
                            <form id="register" action="">
                                <div id="div-id" class="form-group ">
                                    <label>รหัสบัตรประชาชน</label>
                                    <!-- onkeyup   pattern="[A-Za-z]{3}"-->
                                    <input id="cid" type="text" onkeyup="check_id(this.value)" class="form-control" placeholder="รหัสบัตรประชาชน">
                                    <p id="txt-id">กรุณากรอกรหัสประจำตัว 13 หลัก</p>
                                    <script>
                                        function check_id(str) {

                                            if (str.length != 13 && str.length != 0) {
                                                document.getElementById("txt-id").innerHTML = "กรุณากรอกรหัสประจำตัวให้ครบ 13 หลัก";
                                                document.getElementById('div-id').className = 'form-group has-error';
                                                accuracy_id = "";
                                                return;
                                            }
                                            if (str.length == 0) {
                                                document.getElementById("txt-id").innerHTML = "กรุณากรอกรหัสประจำตัว 13 หลัก";
                                                document.getElementById('div-id').className = 'form-group ';
                                                accuracy_id = "";
                                                return;
                                            } else if (str.length == 13) {
                                                var xmlhttp = new XMLHttpRequest();
                                                // xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                                xmlhttp.onreadystatechange = function() {
                                                    if (this.readyState == 4 && this.status == 200) {
                                                        //โค้ดการทำงาน
                                                        // alert(this.responseText);
                                                        alert(this.responseText);
                                                        if (this.responseText == 'success') {
                                                            console.log(this.responseText);
                                                            document.getElementById('div-id').className = 'form-group has-success ';
                                                            document.getElementById("txt-id").innerHTML = "สามารถใช้ ID 13 หลักนี้ได้";
                                                            accuracy_id = "success";
                                                            return;
                                                        } else if (this.responseText == 'error') {
                                                            document.getElementById('div-id').className = 'form-group has-error';
                                                            document.getElementById("txt-id").innerHTML = "มีผู้ใช้นี้ในระบบ";
                                                            accuracy_id = "";
                                                            return;
                                                        }
                                                    }
                                                }
                                                xmlhttp.open("GET", "./controller/check_register.php?id=" + str, true);
                                                xmlhttp.send(null);
                                                // return;
                                            }
                                        }
                                    </script>
                                </div>
                                <div id="div-name" class="form-group ">
                                    <label> Name</label>
                                    <input id="uname" onkeyup="check_name(this.value)" type="text" class="form-control" placeholder=" Name">
                                    <p id="txt-name">กรุณากรอกชื่อตามความจริง</p>
                                    <script>
                                        function check_name(str) {

                                            if (/^[ก-๏\s]+$/.test(str) != true && /^[a-zA-Z\s]+$/.test(str) != true && str.length != 0) {
                                                document.getElementById("txt-name").innerHTML = "กรุณากรอกชื่อตามความจริง";
                                                document.getElementById('div-name').className = 'form-group has-error';
                                                accuracy_name = "";
                                                return;
                                            }
                                            if (str.length == 0) {
                                                document.getElementById("txt-name").innerHTML = "กรุณากรอกชื่อตามความจริง";
                                                document.getElementById('div-name').className = 'form-group ';
                                                accuracy_name = "";
                                                return;
                                            } else {
                                                document.getElementById("txt-name").innerHTML = "สามารถใช้ชื่อนี้ได้";
                                                document.getElementById('div-name').className = 'form-group has-success';
                                                accuracy_name = "success";
                                                return;
                                            }
                                        }
                                    </script>
                                </div>
                                <div id="div-lastname" class="form-group">
                                    <label>Last Name</label>
                                    <input id="lastname" type="text" onkeyup="check_lastname(this.value)" class="form-control" placeholder="Last Name" required>
                                    <p id="txt-lastname">กรุณากรอกนามสกุลตามความจริง</p>
                                    <script>
                                        function check_lastname(str) {
                                            if (/^[ก-๏\s]+$/.test(str) != true && /^[a-zA-Z\s]+$/.test(str) != true && str.length != 0) {
                                                document.getElementById("txt-lastname").innerHTML = "กรุณากรอกนามสกุลตามความจริง";
                                                document.getElementById('div-lastname').className = 'form-group has-error';
                                                accuracy_lastname = "";
                                                return;
                                            }
                                            if (str.length == 0) {
                                                document.getElementById("txt-lastname").innerHTML = "กรุณากรอกนามสกุลตามความจริง";
                                                document.getElementById('div-lastname').className = 'form-group ';
                                                accuracy_lastname = "";
                                                return;
                                            } else {
                                                document.getElementById("txt-lastname").innerHTML = "กรุณากรอกนามสกุลตามความจริง";
                                                document.getElementById('div-lastname').className = 'form-group has-success';
                                                accuracy_lastname = "success";
                                                return;
                                            }
                                        }
                                    </script>
                                </div>
                                <div id="div-mail" class="form-group">
                                    <label>Email address</label>
                                    <input id="email" type="email" onkeyup="check_email(this.value)" class="form-control" placeholder="Email" required>
                                    <p id="txt-mail">กรุณาระบุ E-Mail Address</p>
                                    <script>
                                        function check_email(str) {
                                            if (str.length == 0) {
                                                document.getElementById("txt-mail").innerHTML = "กรุณาระบุ E-Mail Address ";
                                                document.getElementById('div-mail').className = 'form-group';
                                                accuracy_id = "";
                                                return;
                                            } else {
                                                var xmlhttp = new XMLHttpRequest();

                                                xmlhttp.onreadystatechange = function() {
                                                    if (this.readyState == 4 && this.status == 200) {
                                                        //โค้ดการทำงาน
                                                        if (/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/.test(str) != true) {
                                                            document.getElementById('div-mail').className = 'form-group has-error';
                                                            document.getElementById("txt-mail").innerHTML = "ไม่สามารถใช้ E-Mail Address นี้ได้";
                                                            accuracy_mail = "";
                                                            return;
                                                        }
                                                        if (this.responseText == 'success') {
                                                            document.getElementById('div-mail').className = 'form-group has-success';
                                                            document.getElementById("txt-mail").innerHTML = "";
                                                            accuracy_mail = "success";
                                                        } else if (this.responseText == 'error') {
                                                            document.getElementById('div-mail').className = 'form-group has-error';
                                                            document.getElementById("txt-mail").innerHTML = "ไม่สามารถใช้ E-Mail Address นี้ได้";
                                                            accuracy_mail = "";
                                                        }

                                                    }
                                                }
                                                xmlhttp.open("GET", "./controller/check_register.php?email=" + str, true);
                                                xmlhttp.send(null);
                                                // return;
                                            }
                                        }
                                    </script>
                                </div>
                                <div id="div-phone" class="form-group">
                                    <label>PHONE</label>
                                    <input id="phone" onkeyup="check_phone(this.value)" type="text" class="form-control" placeholder="PHONE">
                                    <p id="txt-phone">กรุณากรอกมือถือที่ติดต่อได้</p>
                                    <script>
                                        function check_phone(str) {
                                            var phone = document.getElementById("phone");
                                            // if(str.length == 3 || str.length == 7 ){
                                            //     phone.value += "-";
                                            // }
                                            if (/[0-9]{3}[0-9]{3}[0-9]{4}/.test(str) != true && str.length != 0) {
                                                document.getElementById("txt-phone").innerHTML = "กรุณากรอกมือถือที่ติดต่อได้";
                                                document.getElementById('div-phone').className = 'form-group has-error';
                                                accuracy_phone = "";
                                                return;
                                            }else if (str.length == 0) {
                                                document.getElementById("txt-phone").innerHTML = "กรุณากรอกมือถือที่ติดต่อได้";
                                                document.getElementById('div-phone').className = 'form-group ';
                                                accuracy_phone = "";
                                                return;
                                            } else {
                                                document.getElementById("txt-phone").innerHTML = "สามารถใช้เบอร์มือถือนี้ได้";
                                                document.getElementById('div-phone').className = 'form-group has-success';
                                                str_pho1= str.substring(0, 3);
                                                str_pho2= str.substring(3, 6);
                                                str_pho3= str.substring(6, );
                                                phone.value = str_pho1+"-"+str_pho2+"-"+str_pho3;
                                                accuracy_phone = "success";
                                                return;
                                            }
                                        }
                                    </script>
                                </div>
                                <div id="div-pass" class="form-group">
                                    <!-- [a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 3}$ -->
                                    <label>Password</label>
                                    <input id="pass" onkeyup="check_pass(this.value)" type="password" class="form-control" placeholder="Password">
                                    <p id="txt-pass">ต้องผสมด้วย A-Za-z0-9!@#$%^&* จำนวน 6 - 20 ตัว</p>
                                    <script>
                                        function check_pass(str) {
                                            if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[ -/:-@\[-`{-~]).{6,64}$/.test(str) != true && str.length != 0) {
                                                document.getElementById("txt-pass").innerHTML = "ต้องผสมด้วย A-Za-z0-9!@#$%^&* จำนวน 8 - 12 ตัว";
                                                document.getElementById('div-pass').className = 'form-group has-error';
                                                accuracy_pass = "";
                                                return;
                                            }else if (str.length == 0) {
                                                document.getElementById("txt-pass").innerHTML = "ต้องผสมด้วย A-Za-z0-9!@#$%^&* จำนวน 8 - 12 ตัว";
                                                document.getElementById('div-pass').className = 'form-group ';
                                                accuracy_pass = "";
                                                return;
                                            } else {
                                                document.getElementById("txt-pass").innerHTML = "สามารถใช้รหัสผ่านนี้ได้";
                                                document.getElementById('div-pass').className = 'form-group has-success';
                                                accuracy_pass = "success";
                                                return;
                                            }
                                        }
                                    </script>
                                </div>
                                <div id="div-position" class="form-group">
                                    <label>position</label>
                                    <input id="position"onkeyup="check_position(this.value)" type="text" class="form-control" placeholder="position">
                                    <p id="txt-position">ตำแหน่งงานปัจจุบัน</p>
                                    <script>
                                        function check_position(str) {
                                            if (str.length <= 4) {
                                                document.getElementById("txt-position").innerHTML = "ตำแหน่งงานปัจจุบัน";
                                                document.getElementById('div-position').className = 'form-group has-error';
                                                accuracy_position = "";
                                                return;
                                            } else {
                                                document.getElementById("txt-position").innerHTML = "";
                                                document.getElementById('div-position').className = 'form-group has-success';
                                                accuracy_position = "success";
                                                return;
                                            }
                                        }
                                    </script>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input id="check-box" onclick="check_box()" type="checkbox"> Agree the terms and policy
                                    </label>
                                    <script>
                                        function check_box() {
                                            // checkBox.checked = false
                                            var checkBox = document.getElementById("check-box");
                                            var btn = document.getElementById("submit-registers");
                                            if (checkBox.checked == true) {
                                                btn.style.display = "block";
                                            } else {
                                                btn.style.display = "none";
                                            }

                                        }
                                    </script>
                                </div>

                                <!-- onclick="send_data('submit-registers')" -->
                                <button style="display:none" id="submit-registers" onclick="send_data('submit-registers')" name="submit-registers" type="button" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>
                                <script>
                                    function send_data(key) {
                                        var submit = document.getElementById("submit-registers");

                                        var cid = document.getElementById("cid").value;
                                        var uname = document.getElementById("uname").value;
                                        var lastname = document.getElementById("lastname").value;
                                        var pass = document.getElementById("pass").value;
                                        var phone = document.getElementById("phone").value;
                                        var email = document.getElementById("email").value;
                                        var position = document.getElementById("position").value;

                                        // alert(cid+uname+lastname+pass+email+position)
                                        if (accuracy_id == "success" 
                                        && accuracy_name == "success"
                                         && accuracy_lastname == "success" 
                                         && accuracy_mail == "success"
                                         && accuracy_pass == "success"
                                         &&accuracy_phone == "success"
                                         && accuracy_position == "success"
                                         ) {
                                            swal({
                                                    title: "Are you sure?",
                                                    text: "Once deleted, you will not be able to recover this imaginary file!",
                                                    icon: "warning",
                                                    buttons: true,
                                                    dangerMode: true,

                                                })
                                                .then((willDelete) => {
                                                    if (willDelete) {
                                                        $.ajax({
                                                            type: "POST",
                                                            data: {
                                                                data: key,
                                                                cid: cid,
                                                                uname: uname,
                                                                lastname: lastname,
                                                                phone: phone,
                                                                email: email,
                                                                pass: pass,
                                                                position: position
                                                            },
                                                            url: "./controller/check_register.php",
                                                            success: function(data) {
                                                                swal("Hey, i will close in 2 seconds !!", {
                                                                    icon: "success",
                                                                    buttons: false,
                                                                    timer: 2000,
                                                                });

                                                            },
                                                            error: function() {

                                                            }
                                                        });

                                                    } else {
                                                        swal("Your imaginary file is safe!");
                                                    }
                                                });
                                        } else {
                                            swal("", "ตรวจสอบข้อมูลอีกครั้ง!", "info");
                                        }
                                    }
                                </script>
                                <div class="register-link m-t-15 text-center">
                                    <p>Already have account ? <a href="./login.php"> Sign in</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../script/assets/js/sweetalert.min.js"></script>
    <script src="../script/assets/js/lib/jquery.min.js"></script>
</body>

</html>