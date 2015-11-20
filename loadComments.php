<?php
/**
 * LOAD USER COMMENTS
 * /o/feedback/loadUserComments.php
 * php load script for:
 * /js/sketch3.js
 * /o/feedback/index.php
 * Created by Mike Sperone on 10/1/15.
 * c - 2014-2015
 *
 * This files finds and gathers users' videos for their personal page.
 * Date: 10/1/15
 * Time: 2:33 PM
 */

$table = getComments();

$filenames = [];
$comments = [];
while ($row = $table->fetch_assoc()) {
	$data[] = $row;
    //$filenames[] = $row['filename'];
    //$comments[] = $row['comment'];
}
$combinedData = [$filenames, $comments];

echo json_encode($data);

//echo json_encode($combinedData);
//TODO: get filenames and comments to go into sketchC.js properly/separately

function getComments(){
    require("../../../php/sitefiles/login.php");
    try {
        $connection = mysqli_connect($servername, $username, $password, $dbname);

        if (!$connection) {
            throw new Exception("Unable to connect");
        } else {
            return getVideoComments($connection);
        }
    } catch (Exception $e) {
        header('Location: https://onceonly.org/index.php?error=connection');
    }
}
function getVideoComments($conn) {
    $sql = "SELECT * FROM `onceVideoComments`";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

?>