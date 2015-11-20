<?php

/**
 * LOAD USER VIDEOS
 * /o/feedback/loadUserVideos.php
 * php load script for:
 * /js/sketchPortfolio.js
 * /o/feedback/personal.php
 * Created by Mike Sperone on 9/28/15.
 * c - 2014-2015
 *
 * This files finds and gathers users' videos for their personal page.
 * Date: 9/28/15
 * Time: 4:37 PM
 */
//session_start();

function getVid($id){
    require("../../../php/sitefiles/login.php");
    try {
        $connection = mysqli_connect($servername, $username, $password, $dbname);

        if (!$connection) {
            throw new Exception("Unable to connect");
        } else {
            return getUserVideos($id, $connection);
        }
    } catch (Exception $e) {
        header('Location: https://onceonly.org/index.php?error=connection');
    }
}
function getUserVideos($ident, $conn) {

    $sql = "SELECT `DavidChalmers`, `MoranCerf`, `HeatherBerlin` FROM `onceVideo` WHERE `id` = ".$ident;
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_row($result);
    } else {
        $row = "false";
    }
    return $row;
}

?>