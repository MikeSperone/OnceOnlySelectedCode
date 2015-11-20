<?php
    $interviews = '<a href="https://onceonly.org/o/">Interviews</a>';
    $Binterviews = '<a class="inactive" href="https://onceonly.org/?h=1">Interviews</a>';
    $feedback = '<a href="https://onceonly.org/o/feedback/">Feedback</a>';
    $Beedback = '<a class="inactive" href="https://onceonly.org/?h=1">Feedback</a>';
    $inactive = 'hide';
    if (isset($_SESSION['fullMenu'])) {
        $fullMenu = $_SESSION['fullMenu'];
        if ($fullMenu == "true") {
            $onceLink = '<a class="contentLink" href = "https://onceonly.org/o/" >';
        } else {
            $onceLink = '<a class="contentLink" href = "https://onceonly.org/?h=1" >';
        }
    } else {
        // TODO: what to do if no 'fullMenu'?
        // Why no 'fullMenu'?
        // 1. direct link
        // Possible solution:
        // make all email links and others include $fullMenu
        // 2. typed into browser to page
        // redirect back home?
        // if all email links must contain $fullMenu anyway... then ...
        //
    }
?>
<script>
    sessionStorage.setItem('pleaseAllow', 'true');
</script>
<div class="header-menu">
    <div class="box">
        <header>
            <?php echo $onceLink ?>
            Once Only</a></header>
    </div><br />
    <div class="box">

        <div id='cssmenu'>
            <ul>
                <li class='has-sub'><a href='https://onceonly.org/o/about.php'><span>About</span></a>
                    <ul>
                        <li><a href='https://onceonly.org/o/about.php'><span>Once Only</span></a></li>
                        <li><a href='https://onceonly.org/o/installation.php'><span>Installation</span></a></li>
                        <li><a href='https://onceonly.org/o/team.php'><span>Team</span></a></li>
                        <li class='last'><a href='https://onceonly.org/o/credits.php'><span>Credits</span></a></li>
                    </ul>
                </li>
                <li class="left-center" ><?php if ($fullMenu == "true") { echo $interviews; } else { echo $Binterviews; } ?></li>
                <li class='right-center has-sub <?php if ($fullMenu != "true") { echo $inactive; } ?>' id="has-sub-feedback"><?php if ($fullMenu == "true") { echo $feedback; } else { echo $Beedback; } ?>
                    <ul>
                        <li><a href='https://onceonly.org/o/feedback/'><span>Societal</span></a></li>
                        <li><a href='https://onceonly.org/o/comingsoon.php'><span>Photomorph</span></a></li>
                        <li class='last'><a href='https://onceonly.org/o/feedback/personal.php'><span>Personal</span></a></li>
                    </ul>
                </li>
                <li class='last'><a href='http://onceonly.org/contact.php'><span>Contact</span></a></li>
            </ul>
        </div>
    </div>
</div>
