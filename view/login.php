<!DOCTYPE html>
<html lang="en">

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
    
    <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-content">
                        <div class="login-form">

                            <div class="card-body">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#personnel" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Personnel</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#admin" role="tab"><span class="hidden-sm-up"><i class="ti-headphone-alt"></i></span> <span class="hidden-xs-down">Admin</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane active" id="personnel" role="tabpanel">
                                        <div class="p-20">
                                            <h3><span>บุคลากร</span></h3>
                                            <!-- action="./personnel/dashboard.php" -->
                                            <form method="post">
                                                <div class="form-group">
                                                    <label>อีเมล</label>
                                                    <input id="email_per" type="email" class="form-control" placeholder="Email">
                                                </div>
                                                <div class="form-group">
                                                    <label>รหัสผ่าน</label>
                                                    <input id="password_per" type="password" class="form-control" placeholder="Password">
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" id="rememberMe_per" onclick="lsRememberMe()"> Remember Me
                                                    </label>
                                                    <label class="pull-right">
                                                        <!-- <a href="#">Forgotten Password?</a> -->
                                                    </label>
                                                    <script>
                                                        const rmCheck = document.getElementById("rememberMe_per"),
                                                            emailInput = document.getElementById("email_per"),
                                                            passwordInput = document.getElementById("password_per");

                                                        if (localStorage.checkbox && localStorage.checkbox !== "") {
                                                            rmCheck.setAttribute("checked", "checked");
                                                            emailInput.value = localStorage.username;
                                                            passwordInput.value = localStorage.password;
                                                        } else {
                                                            rmCheck.removeAttribute("checked");
                                                            emailInput.value = "";
                                                            passwordInput.value = "";
                                                        }

                                                        function lsRememberMe() {
                                                            if (rmCheck.checked && emailInput.value !== "") {
                                                                localStorage.username = emailInput.value;
                                                                localStorage.checkbox = rmCheck.value;
                                                                localStorage.password = passwordInput.value;
                                                            } else {
                                                                localStorage.username = "";
                                                                localStorage.checkbox = "";
                                                                localStorage.password = "";
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                                <button id="submit_per" onclick="send_submit_per('submit_per')" type="button" class="btn btn-primary btn-flat m-b-30 m-t-30">Sign in</button>

                                                <div class="register-link m-t-15 text-center">
                                                    <p>ไม่มีบัญชี ? <a href="./register.php"> Sign Up Here</a></p>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="admin" role="tabpanel">
                                        <div class="p-20">
                                            <h3><span>Admin</span></h3>
                                            <form action="./admin/dashboard_ad.php" method="post">
                                                <div class="form-group">
                                                    <label>Email address</label>
                                                    <input id="email_ad" type="email" class="form-control" placeholder="Email">
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input id="password_ad" type="password" class="form-control" placeholder="Password">
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input id="rememberMe_ad" type="checkbox" onclick="lsRememberMe_ad()"> Remember Me
                                                    </label>
                                                    <label class="pull-right">
                                                        <!-- <a href="#">Forgotten Password?</a> -->
                                                    </label>
                                                    <script>
                                                        const rmCheck_ad = document.getElementById("rememberMe_ad"),
                                                            emailInput_ad = document.getElementById("email_ad"),
                                                            passwordInput_ad = document.getElementById("password_ad");

                                                        if (localStorage.checkbox_ad && localStorage.checkbox_ad !== "") {
                                                            rmCheck_ad.setAttribute("checked", "checked");
                                                            emailInput_ad.value = localStorage.username_ad;
                                                            passwordInput_ad.value = localStorage.password_ad;
                                                        } else {
                                                            rmCheck_ad.removeAttribute("checked");
                                                            emailInput_ad.value = "";
                                                            passwordInput_ad.value = "";
                                                        }

                                                        function lsRememberMe_ad() {
                                                            if (rmCheck_ad.checked && emailInput_ad.value !== "") {
                                                                localStorage.username_ad = emailInput_ad.value;
                                                                localStorage.checkbox_ad = rmCheck_ad.value;
                                                                localStorage.password_ad = passwordInput_ad.value;
                                                            } else {
                                                                localStorage.username_ad = "";
                                                                localStorage.checkbox_ad = "";
                                                                localStorage.password_ad = "";
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                                <button id="submit_ad" onclick="send_submit_ad('submit_ad')" type="button" class="btn btn-primary btn-flat m-b-30 m-t-30">Sign in</button>
                                                <!-- <div class="register-link m-t-15 text-center">
                                                    <p>Don't have account ? <a href="./register.php"> Sign Up Here</a></p>
                                                </div> -->
                                            </form>
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
    <script>
        var input = document.getElementById("password_per");
        input.addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
                // event.preventDefault();
                // send_submit_per('submit_per');
            }
        });

        function send_submit_per(key) {
            // alert(key);
            var email_per = document.getElementById("email_per").value;
            var password_per = document.getElementById("password_per").value;

            $.ajax({
                type: "POST",
                url: "./controller/chack_login.php",
                data: {
                    key: key,
                    email: email_per,
                    password: password_per
                },
                success: function(result, textstatus, jqXHR) {
                    // alert('Success');
                    // alert(jqXHR.status);
                    var json = JSON.parse(result);
                    if (json != false) {
                        if (email_per == json['e_mail'] && password_per == json['pass']) {
                            location.assign("./personnel/dashboard.php");
                        }

                    } else {
                        alert('E-mail หรือ Password ไม่ถูกต้อง');
                    }
                    // alert(textstatus + jqXHR.status)
                    // alert(jqXHR.status + ' ' + jqX.readyState);
                    // if(textstatus=="success" && jqXHR.status=="200"){

                    // }
                },
                error: function(jqXHR, textstatus, error) {
                    alert(jqXHR.status);
                    if (jqXHR.status == 404) {
                        location.assign('./error/error-404.html')
                    } else if (jqXHR.status == 400) {
                        location.assign('./error/error-404.html')
                    } else if (jqXHR.status == 403) {
                        location.assign('./error/error-404.html')
                    } else if (jqXHR.status == 500) {
                        location.assign('./error/error-404.html')
                    } else if (jqXHR.status == 503) {
                        location.assign('./error/error-404.html')
                    }
                    // location.assign('./error/error-404.html')
                }
            });

            // alert(email_per+ ' ' + password_per)


        }

        function send_submit_ad(key) {
            // alert(key);
            var email_ad = document.getElementById("email_ad").value;
            var password_ad = document.getElementById("password_ad").value;

            $.ajax({
                type: "POST",
                url: "./controller/chack_login.php",
                data: {
                    key: key,
                    e_emil_ad: email_ad,
                    pass_ad: password_ad
                },
                success: function(result, textstatus, jqXHR) {
                    // alert(result);
                    // alert(jqXHR.status);
                    var json = JSON.parse(result);
                    if (json != false) {
                        if (email_ad == json['e_emil_ad'] && password_ad == json['pass_ad']) {
                            location.assign("./admin/dashboard_ad.php");
                        }

                    } else {
                        alert('E-mail หรือ Password ไม่ถูกต้อง');
                    }

                },
                error: function(jqXHR, textstatus, error) {
                    // alert(jqXHR.status);
                    if (jqXHR.status == 404) {
                        location.assign('./error/error-404.html')
                    } else if (jqXHR.status == 400) {
                        location.assign('./error/error-404.html')
                    } else if (jqXHR.status == 403) {
                        location.assign('./error/error-404.html')
                    } else if (jqXHR.status == 500) {
                        location.assign('./error/error-404.html')
                    } else if (jqXHR.status == 503) {
                        location.assign('./error/error-404.html')
                    }
                    // location.assign('./error/error-404.html')
                }
            });

            // alert(email_per+ ' ' + password_per)


        }
    </script>
    <script>
        function show_form(id) {
            if (id == "show_admin") {
                document.getElementById("form_admin").style.display = "";
                document.getElementById("form_member").style.display = "none";
            } else if (id == "show_mamber") {
                document.getElementById("form_member").style.display = "";
                document.getElementById("form_admin").style.display = "none";
            }
        }
    </script>

    <!-- jquery vendor -->
    <script src="../script/assets/js/lib/jquery.min.js"></script>
    <script src="../script/assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="../script/assets/js/lib/menubar/sidebar.js"></script>
    <script src="../script/assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->

    <!-- bootstrap -->
    <script src="../script/assets/js/sweetalert.min.js"></script>
    <!-- <script src="../script/assets/js/lib/jquery.min.js"></script> -->

    <script src="../script/assets/js/lib/bootstrap.min.js"></script>
    <script src="../script/assets/js/scripts.js"></script>
    <!-- scripit init-->

</body>

</html>