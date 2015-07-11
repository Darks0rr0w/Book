<?php
require_once('Admin.php');
require_once('Entry.php');
require_once('DataBase.php');
if(isset($_POST['login'])) {
    $user = new Admin();
    if ($user->verifyAdmin($_POST['username'], $_POST['password'])){
        $user->login();
        header("Location: http://localhost/Book/");
    }
}


?>
<!DOCTYPE HTML>


<html lang="en">


<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <title>Complains and suggestions</title>

</head>

<body>

<p class = "lead" align="center">Complains and suggestions</p>

<div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Sign In</div>
            </div>
            <?php
            if (isset($_POST['login']) && (!Admin::isAdmin())){
                echo '<div class="alert alert-danger">Incorrect username or password</div>';
            }
            ?>
            <div style="padding-top:30px" class="panel-body" >

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                <form id="loginform" class="form-horizontal" role="form" method="post" action="login.php">

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email">
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                    </div>



                    <div class="input-group">
                        <div class="checkbox">
                            <label>
                                <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                            </label>
                        </div>
                    </div>


                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->

                        <div class="col-sm-12 controls">
                            <button type="submit" id="btn-login" name ="login" class="btn btn-success">Login  </button>


                        </div>
                    </div>



                </form>



            </div>
        </div>
    </div>




    </div>



</body>



</html>


