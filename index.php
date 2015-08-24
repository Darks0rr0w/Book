<?php
require_once('models/Entry.php');
require_once('app/app.php');

    if (isset($_GET['logout'])) {
        Admin::logout();
        header('Location: http://localhost/SnC');
    }
    if (isset($_POST['submit'])){
        if(!empty($_POST['content'])) {
            App::saveEntry();
        } else {
            header("Location: http://localhost/SnC");
            }
        }
    if (isset($_POST['update']) && !empty($_POST['review'])) {
        App::updateStatus();
    }
    if (isset($_POST['update']) && !empty($_POST['delete'])){
        App::deleteEntries();
    }



?>
<!DOCTYPE HTML>


<html lang="en">


<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <title>Suggestions and Complains</title>
    <link rel="stylesheet" href="/SnC/web/style.css">

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
            <form action="/SnC/index.php" method="post">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                      if (!Admin::isAdmin()) {
                          ?>
                          <div>
                          <li><a class="navbar-brand" href="login.php">Login as admin</a></li>
                          </div>
                          <?php
                      }
                    ?>

                    <?php
                        if (Admin::isAdmin()) {
                            ?>
                            <div>
                            <li><a class ='navbar-brand'  name="logout" href="index.php?logout=true">Logout</a></li>
                            </div>
                            <?php
                        }
                    ?>
                </ul>
            </div><!-- /.navbar-collapse -->
            </form>
        </div><!-- /.container-fluid -->
    </nav>


    <p class = "lead" align="center">Complains and suggestions</p>
    <hr>


    <form action="/SnC/index.php" method="POST">
        <?php App::displayAll(); ?>
        <div class="form-group">
            <?php
                if (!Admin::isAdmin()){
            ?>
                <label  for="Content">Leave your opinion below:</label>
                <textarea class="form-control" name="content" rows="5" id="Content"></textarea>
                <input type="submit" name="submit" align="center" class="btn btn-primary" value="Submit">
            <?php
                }
            ?>
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
                    <a href="?page=<?= App::currentPage() - 1 ? : 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>


                <?php  if ((App::currentPage() - 1 && App::currentPage())  == 1) { ?>
                    <li><a href="?page=1">first</a></li>
                <?php } ?>

                <li><a href="?page=<?=App::currentPage()?>"><?=App::currentPage()?></a></li>



                <?php  if ((App::currentPage()  != App::lastPage())) { ?>
                    <li><a href="?page=<?= App::currentPage() + 1  ?>"><?= App::currentPage() + 1  ?></a></li>
                <?php } ?>


                <?php  if ( App::currentPage()  != App::lastPage()) { ?>
                    <li><a href="?page=<?=App::lastPage()?>">last</a></li>
                <?php } ?>
                <li>
                    <a href="?page=<?= App::currentPage() + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        </div>
    </form>
</div>


</body>



</html>


