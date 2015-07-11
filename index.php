<?php

require_once('Entry.php');
$test = new Entry();
    if (isset($_POST['submit'])){
        $test->save();
    }
if(isset($_POST['update']) && !empty($_POST['checkbox']))
{
        $checked_values = $_POST['checkbox'];
        $obj = new Entry();
        $obj->updateStatus($checked_values);

}
?>
<!DOCTYPE HTML>


<html lang="en">


<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <title>Suggestions and Complains</title>
    <link rel="stylesheet" href="style.css">

</head>

    <div id="post">
    <body>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">

                <a class="navbar-brand" href="#">Home</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?
                    <li><a href="login.php">Admin</a></li>
                    <
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>


    <p class = "lead" align="center">Complains and suggestions</p>
    <hr>


    <form action="index.php" method="POST">
        <?php $test->findAll(); ?>
        <div class="form-group">
            <label  for="Content">Leave your opinion below:</label>
            <textarea class="form-control" name="content" rows="5" id="Content"></textarea>
            <input type="submit" name="submit" align="center" class="btn btn-primary" value="Submit">
            <?php
            if (Admin::isAdmin()){
                echo '<input type="submit" name = "update" class="btn btn-primary" value="Update">';
            }
            ?>
        </div>
        <div align="center">
        <nav>
            <ul class="pagination">
                <li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li><a href="?page=1">1</a></li>
                <li><a href="?page=2">2</a></li>
                <li><a href="?page=3">3</a></li>
                <li><a href="?page=4">4</a></li>
                <li><a href="?page=5">5</a></li>
                <li>
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        </div>
    </form>
</div>
</div>

</body>



</html>


