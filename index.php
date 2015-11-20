<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Mike Sperone" />
    <link rel="icon" type="image/png" href="../../favicon.ico" />
    <link rel="stylesheet" type="text/css" href="./css/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="./css/fbk.css" />
    <link rel="stylesheet" type="text/css" href="./css/menu.css" />
    <script src="./js/lib/p5.js" type="text/javascript"></script>
    <script src="./js/lib/p5.dom.js" type="text/javascript"></script>
    <script src="./js/sketchC.js" type="text/javascript"></script>
    <link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css' />
    <script src="./js/lib/jquery-1.11.3.min.js"></script>
</head>
<body>
<div class="site-wrapper">
    <?php require("menu.php"); ?>

    <div class="box" id="main-content">
    </div>
    <?php include("footer.php"); ?>
