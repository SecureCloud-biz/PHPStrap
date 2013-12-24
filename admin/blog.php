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
    <title>PhpStrap - Manage Blog Posts</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">    
    <link rel="stylesheet" href="css/extra.css">    
</head>
<body>
    <?php include 'inc/navigation.php'; ?>
    <div class="container">
        <div class="row-fluid">
            <div class="span4">
                <div class="well well-small">
                    <strong>Sub-Directories</strong><br />
                    All Posts<br />
                    <a href="newpost.php">New Post</a>
                </div>
            </div>
            <div class="span8">
                <div class="well well-small">
                    <strong>Manage Blog Posts.</strong><br /><br />
                    <div class="row-fluid">
                        <div class="span6">
                            <strong>Title</strong>
                        </div>
                        <div class="span4">
                            <strong>Author</strong>
                        </div>
                        <div class="span2">
                            <strong>Edit / Delete</strong>
                        </div>
                    </div>
                    <?php
                    $getusers= $conn->query("SELECT DISTINCT * FROM posts ORDER BY post_id DESC")
                    or die(mysql_error()); 
                    
                    while($db_field = $getusers->fetch_array()) {
                    ?>
                    <div class="row-fluid">
                        <div class="span6">
                            <small>(<?php echo $db_field['post_id']; ?>)</small> <?php echo $db_field['post_title']; ?>
                        </div>
                        <div class="span4">
                            <?php echo $db_field['author_id']; ?>
                        </div>
                        <div class="span1">
                            <a href=""><i class="icon-wrench"></i></a>
                        </div>
                        <div class="span1">
                            <a href=""><i class="icon icon-remove-sign"></i></a>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div style="text-align: center;font-size: small;">Powered by <a href="http://www.getphpstrap.com/" target="_blank">PhpStrap</a></div>
    </div>
</body>
</html>
<?php
} else { header("Location: ../"); }
$conn->close();
?>