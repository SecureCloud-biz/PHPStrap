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
	<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
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
					<?php if(!isset($_GET['edit'])) { ?>
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
                    $getusers= $conn->query("SELECT DISTINCT * FROM posts ORDER BY post_id asc")
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
                            <a href="?edit=<?php echo $db_field['post_id']; ?>"><i class="icon-wrench"></i></a>
                        </div>
                        <div class="span1">
                            <a href="?delete=<?php echo $db_field['post_id']; ?>"><i class="icon icon-remove-sign"></i></a>
                        </div>
                    </div>
                    <?php
                    }
						} elseif(isset($_GET['edit'])) { 
						$guId = $conn->real_escape_string($_GET['edit']);
						$getTblUsers = $conn->query("SELECT * FROM posts WHERE post_id = '".$guId."'");
						while($fetchtblUsers = $getTblUsers->fetch_array()) {
					?>
					
					Edit: <b><?php echo $fetchtblUsers['post_title']; ?></b><br /><br />
					
					<form method="post" action="">
						<label for="editUsr">Post Title</label>
						<input type="text" name="editTitle" value="<?php echo $fetchtblUsers['post_title']; ?>" style="padding: 15px; width: 100%;">

						<label for="editMail">Post Content</label>
						<textarea name="editContent" style="padding: 15px; width: 100%; height: 150px;"><?php echo $fetchtblUsers['post_content']; ?></textarea>

						<input type="submit" name="submitPstEdit" value="Save" class="btn btn-success">
					</form>
					
					<?php 
						}
						
						if(isset($_POST['submitPstEdit'])) {
							$newTitle = $conn->real_escape_string($_POST['editTitle']);
							$newContent = $conn->real_escape_string($_POST['editContent']);
							
							$updatePost = $conn->query("UPDATE posts SET post_title = '".$newTitle."', post_content = '".$newContent."'");
							if($updatePost) {
								header("location: blog.php");
							}
						}
					} 
					
					if(isset($_GET['delete'])) {
						$guId = $conn->real_escape_string($_GET['delete']);
						
						$deletePost = $conn->query("DELETE FROM posts WHERE post_id = '".$guId."'");
						if($deletePost) {
							$deletePostLikes = $conn->query("DELETE FROM post_likes WHERE post_id = '".$guId."'");
							if($deletePostLikes) {
								header("location: blog.php");
							}
						}
					} ?>
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
