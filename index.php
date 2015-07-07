<?php
require_once('db.php');
$test = new Entry();
    if (isset($_POST['submit'])){
        $test->save();
    }
?>
<!DOCTYPE HTML>


<html lang="en">


<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <title>Title Goes Here</title>

</head>

<body>

<p class = "lead" align="center">Complains and suggestions</p>

<?php $test->findAll(); ?>
<form action="index.php" method="POST">
    <div class="form-group">
        <label  for="Content">Leave your opinion below:</label>
        <textarea class="form-control" name="content" rows="5" id="Content"></textarea>
        <input type="submit" name="submit" align="center" class="btn btn-primary">
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

</body>



</html>


