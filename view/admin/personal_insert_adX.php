<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Focus Admin: Widget</title>

</head>

<body class="bg-primary">

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
                            <form action="../controller/register.php">
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" class="form-control" placeholder="User Name">
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="email" class="form-control" placeholder="Last Name">
                                </div>
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>position</label>
                                    <select class="form-control">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Agree the terms and policy
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>
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

</body>

</html>