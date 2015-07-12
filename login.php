<?php
require_once('admin/Admin.php');
require_once('Entry.php');
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
    <link rel="stylesheet" href="style.css">
    <title>Complains and suggestions</title>

</head>

<body>

<div id="post">

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">

                <a class="navbar-brand" href="index.php">Home</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <form action="index.php" method="post">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        if (!Admin::isAdmin()) {
                            ?>
                            <li><a href="login.php">Login as admin</a></li>
                            <?php
                        }
                        ?>

                        <?php
                        if (Admin::isAdmin()) {
                            ?>
                            <li><a name="logout" href="index.php?logout=true">Logout</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </form>
        </div><!-- /.container-fluid -->
    </nav>
</div>
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


