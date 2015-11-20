<?php
session_start();

$filename = $_GET['video'];
$_SESSION['id'] = $_GET['userId'];
$videoname = $_GET['videoname'];
$_SESSION['fullMenu']="true";
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Mike Sperone" />
    <link rel="icon" type="image/png" href="../../favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../../css/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="../../css/fbk.css" />
    <link rel="stylesheet" type="text/css" href="../../css/menu.css" />
    <script src="../../js/lib/p5.js" type="text/javascript"></script>
    <script src="../../js/lib/p5.dom.js" type="text/javascript"></script>
    <script src="../../js/sketchEmail.js" type="text/javascript"></script>
    <link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css' />
    <script src="../../js/lib/jquery-1.11.3.min.js"></script>
</head>
<body>
<div class="site-wrapper">
    <?php require("../../menu.php"); ?>
<script>
    var path = "<?php echo $filename; ?>";
    window.onload = function () {
        var type = browser();

        var obj = new Feedback(type+"/"+path, 'frontRow');
        var szX = 480;
        var szY = 360;
        obj.position(centerX_speroneGlobal - (szX / 2), centerY_speroneGlobal - (szY / 2)+50);
        obj.display();
        frontFeedback_speroneGlobal = obj;
    };
</script>


<div class="box" id="main-content">
        <form action="twoEmailAction.php?filename=<?php echo $filename ?>&videoname=<?php echo $videoname ?>" method="post" id="comment-on-your-video" >
            <p>
                <textarea class="contact-txt" id="comment-input" type="text" name="comment" maxlength="140" placeholder="  please enter your comments here (140 character max)"></textarea>
                <input class="button" id="video-comment-submit" type="submit" value="submit" />
            </p>
        </form>
</div>
<?php include("../../footer.php"); ?>
