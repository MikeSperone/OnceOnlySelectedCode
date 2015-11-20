<?php
/**
 * PERSONAL
 * /o/feedback/personal.php
 * User: Mike
 * Date: 9/28/15
 * Time: 4:31 PM
 */
session_start();
require_once("loadUserVideos.php");
$userId = $_SESSION['userId'];
$_SESSION['fullMenu']="true";

$row = getVid($userId);
?>


<!DOCTYPE html>
<html class="overflow">
<head>
    <meta charset="UTF-8">
    <title>Personal</title>
    <meta name="author" content="Mike Sperone" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../../favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../../css/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="../../css/fbk.css" />
    <link rel="stylesheet" type="text/css" href="../../css/brain.css" />
    <link rel="stylesheet" type="text/css" href="../../css/menu.css" />
    <link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css' />
    <script src="../../js/lib/jquery-1.11.3.min.js"></script>
</head>
<body>
<div class="site-wrapper">
    <?php require("../../menu.php"); ?>
    <div class="big-box" id="main-content">
        <div class="portfolio left">
            <b>Moran Cerf</b><br/>
            <?php
            if (isset($row[1])) {
                echo "<video width='360' height='270' onclick='play()'>
                          <source src=\"./videos/webm/" . $row[1] . "\" type='video/webm'>
                      </video>";
            } else {
                echo "<div class='video-alt-center'><br/><br/><br/>It appears you have not yet viewed this interview.</div>";
            }
            ?>
        </div>
        <div class="portfolio center">
            <b>David Chalmers</b><br/>
            <?php
            if (isset($row[0])) {
                echo "<video width='360' height='270' onclick='play()'>
                        <source src=\"./videos/webm/" . $row[0] . "\" type='video/webm'>
                      </video>";
            } else {
                echo "<div class='video-alt-side'><br/><br/><br/>It appears you have not yet viewed this interview.</div>";
            }
            ?>
        </div>
        <div class="portfolio right">
            <b>Heather Berlin</b><br/>
            <?php
                if (isset($row[2])) {
                    echo "<video width='360' height='270' onclick='play()'>
                            <source src=\"./videos/webm/" . $row[2] . "\" type='video/webm'>
                          </video>";
                } else {
                    echo "<div class='video-alt-side'><br/><br/><br/>It appears you have not yet viewed this interview.</div>";
                }
            ?>
        </div>
    </div>
    <?php include("../../footer.php"); ?>
