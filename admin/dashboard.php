<?php

include 'assets/database.php';
session_start();
include 'assets/vars.php';
//Checks to see if the user is able to login to the dashboard.
if (!isset($_SESSION['logged'])) { header("Location: login.php"); }
if ($rank_id == 7) {
?>
<html>
<head>
    <title>PhpStrap Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">    
    <link rel="stylesheet" href="css/extra.css">    
</head>
<body>
    <?php include 'inc/navigation.php'; ?>
    <div class="container">
        <div class="well well-small">
            <strong>Welcome to PhpStrap, <?php echo $user_name; ?>!</strong><br />
            PhpStrap is an open-source development created to help developers and general website owners add new functionalities to their website. PhpStrap allows the integration of users and many other features fit with an administration panel. PhpStrap is built with Bootstrap 2.3.2 with Flatly customisation. Thank you for choosing PhpStrap; use the links in the navigation bar to navigate around your administration panel.
        </div>
        <div class="row-fluid">
            <div class="span4">
                <div class="well well-small">
                    <strong>PhpStrap <?php echo $pstrapv; ?> BETA EDITION.</strong><br />
                    <a href="http://www.getphpstrap.com/" target="_blank">Official Website</a><br />
                    <a href="http://www.getphpstrap.com/documentation.html" target="_blank">Documentation</a><br />
                    <a href="http://www.getphpstrap.com/forum.php" target="_blank">Support Forum</a><br />
                    <a href="http://www.getphpstrap.com/node.php/v/announcements.2" target="_blank">Check for Updates</a>
                </div>
                <div class="well well-small">
                    <a href="newpost.php" class="btn btn-block btn-primary">New Blog Post</a>
                </div>
            </div>
            <div class="span8">
                <div class="well well-small">
                    <strong>Current Statistics.</strong><br /><br />
                    <div class="row-fluid">
                        <div class="span3">
                            <div align="center">
                                <h1 style="margin: 0;"><?php echo $numofusers; ?></h1>
                                <p>Users</p>
                            </div>
                        </div>
                        <div class="span3">
                            <div align="center">
                                <h1 style="margin: 0;"><?php echo $numofposts; ?></h1>
                                <p>Blog Posts</p>
                            </div>
                        </div>
                        <div class="span3">
                            <div align="center">
                                <h1 style="margin: 0;">0</h1>
                                <p>Comments</p>
                            </div>
                        </div>
                        <div class="span3">
                            <div align="center">
                                <h1 style="margin: 0;">0</h1>
                                <p>Pages</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="well well-small">
                    <div style="padding-bottom: 2px;text-align: center;">"Bootstrapping refers to a self-sustaining process that proceeds without external help."</div>
                </div>
            </div>
        </div>
        <!--
<div class="well well-small">
            <div class="row-fluid">
                <div class="span8" style="text-align: center;">
                    <strong>Get PhpStrap Pro now!</strong> Have the ability to add a report system, feedback system, gallery system, poll system, FAQ system and downloads system to your website!
                </div>
                <div class="span4">
                    <a target="_blank" href="http://www.getphpstrap.com/pro/" class="btn btn-block btn-success">Upgrade now!</a>
                </div>
            </div>
        </div>
        -->
        <div style="text-align: center;font-size: small;">Powered by <a href="http://www.getphpstrap.com/" target="_blank">PhpStrap</a></div>
    </div>
</body>
</html>
<?php
} else { header("Location: ../"); }
$conn->close();
?>