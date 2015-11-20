<?php session_start();

$videolink = $_GET['video'];
$_SESSION['address'] = $_GET['address'];
$_SESSION['fullMenu']="true";

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Your Feedback</title>
        <meta charset="utf-8" />
        <meta name="author" content="Mike Sperone" />
        <link rel="icon" type="image/png" href="../../../favicon.ico" />
        <link rel="stylesheet" type="text/css" href="../../../css/brain.css" />
        <link rel="stylesheet" type="text/css" href="../../../css/menu.css" />
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,900' rel='stylesheet' type='text/css' />
        <link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css' />
        <script src="../../../js/lib/jquery-1.11.3.min.js"></script>
    </head>
<body>
<div class="site-wrapper">
<?php 	require("../../../menu.php"); ?>
    <div class="box" id="main-content">
        <div class="information">
            <video controls height="auto" width="600" >
                <?php
                echo "<source src= '".$videolink."' type='video/webm' />";
                ?>
            </video>
        </div>
        <div class="spacer"><br/><br/><br/><br/><br/><br/><br/></div>
    </div><br />

<?php require("../../../footer.php"); ?>