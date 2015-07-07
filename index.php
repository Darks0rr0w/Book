<?php
require_once('db.php');
$test = new Entry();
?>
<!DOCTYPE HTML>


<html lang="en">


<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <title>Title Goes Here</title>

</head>

<body>

<p>Complains and suggestions</p>

<?php $test->findAll(); ?>

</body>



</html>


