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
    <title>PhpStrap - New Blog Post</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">    
    <link rel="stylesheet" href="css/extra.css">
    <link rel="stylesheet" href="css/tinyeditor.css">
    <style type="text/css">
        .input-large {width: 100%;}
    </style>
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
</head>
<body>
    <?php include 'inc/navigation.php'; ?>
    <div class="container">
        <div class="row-fluid">
            <div class="span12">
                <div class="well well-small">
                    <strong>New Blog Post (<a href="blog.php">Go back</a>). </strong><br /><br />
                    <form class="form-horizontal" action="newpost.php" method="POST">
                    <input placeholder="Post Title" style="height: 40px;" type="text" class="input-large" name="post_title"><br /><br />
                    <textarea name="post_content" style="width: 100%; height: 300px"></textarea><br />
                    <button name="submit" value="submit" type="submit" class="btn btn-block btn-success">New Blog Post</button>
                    </form>
                </div>
            </div>
        </div>
        <div style="text-align: center;font-size: small;">Powered by <a href="http://www.getphpstrap.com/" target="_blank">PhpStrap</a></div>
    </div>
</body>
</html>
<?php
} else { header("Location: ../"); }

//Inserting Post to Database
if(isset($_POST['submit'])){
$dateposted = date("d/m/y");
$author_id = $user_id;
$post_title = $_POST['post_title'];
$post_content = $_POST['post_content'];

$conn->query("INSERT INTO posts (dateposted, author_id, post_title, post_content) VALUES (
'" . mysql_real_escape_string($dateposted) . "',
'" . mysql_real_escape_string($author_id) . "',
'" . mysql_real_escape_string($post_title) . "',
'" . mysql_real_escape_string($post_content) . "')
");
header("Location: newpost.php");
}

$conn->close();
?>