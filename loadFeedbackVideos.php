<?php
/**
 * LOAD FEEDBACK VIDEOS
 * /o/feedback/loadFeedbackVideos.php
 * php load script for:
 * /js/sketch3.js
 * /o/feedback/index.php
 * Created by Mike Sperone
 * c - 2014-2015
 *
 * This files finds and gathers users' videos for their personal page.
 * Date: 9/08/15
 * Time: 11:00AM PM
 */

$feedbackVideos = scandir("../feedback/videos/".$_GET['type']);
echo json_encode($feedbackVideos);

?>