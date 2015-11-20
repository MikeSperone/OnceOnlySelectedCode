<?php
session_start();

$userId = htmlspecialchars($_SESSION['id']);
$name = htmlspecialchars($_GET['videoname']);

$file = htmlspecialchars($_GET['filename']);
$comment = htmlspecialchars($_POST['comment']);

takeAction($userId, $name, $comment, $file);

function takeAction($userId, $name, $comment, $file) {
    require("../../../php/sitefiles/login.php");
    try {
        $connection = mysqli_connect($servername, $username, $password, $dbname);

        if (!$connection) {
            throw new Exception("Unable to connect");
        } else {
            $file = mysqli_real_escape_string($connection, $file);
            $comment = mysqli_real_escape_string($connection, $comment);
            $userId = mysqli_real_escape_string($connection, $userId);
            $name = mysqli_real_escape_string($connection, $name);
            postVideoComment($file, $comment, $connection);
            postComment($userId, $connection, $name, $comment);
        }
    } catch (Exception $e) {
        header('Location: https://onceonly.org/index.php?error=connection');
    }
}

function postVideoComment($filename, $comment, $conn) {       // this database stores filename and comment only

    $sql = "UPDATE `onceVideoComments` SET `comment`=\"".$comment."\" WHERE `filename` = \"".$filename."\"";
    mysqli_query($conn, $sql);
    //mysqli_close($conn);
}

function postComment($id, $conn, $name, $comment) {         // this database links comments with their userId and interview name

    $sql = "UPDATE onceComments SET ".$name." = '".$comment."' WHERE id = ".$id;

    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header('Location: https://onceonly.org/o/feedback/');
}

?>