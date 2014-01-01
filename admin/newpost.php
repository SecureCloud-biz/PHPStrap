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
    <script type="text/javascript" src="../tinymce/js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
	tinymce.init({
		selector: "textarea"
	 });
	</script>
</head>
<body>
    <?php include 'inc/navigation.php'; ?>
    <div class="container">
        <div class="row-fluid">
            <div class="span12">
				<?php
					//Inserting Post to Database
					if(isset($_POST['submit'])){
					$dateposted = date("d/m/y");
					$author_id = $user_id;
					$post_title = $conn->real_escape_string($_POST['post_title']);
					$post_content = $conn->real_escape_string($_POST['post_content']);

					$addPost = $conn->query("INSERT INTO posts (dateposted, author_id, post_title, post_content, likes) VALUES (
					'" . $dateposted . "',
					'" . $author_id . "',
					'" . $post_title . "',
					'" . $post_content . "',
					'0')
					");

					if($addPost) {
						echo "<div style='background: green; color:#FFF; border-radius:4px; margin-bottom: 15px; padding: 15px;'>Your post was successfully added.</div>";
					} else {
						echo "<div style='background: red; color:#FFF; border-radius:4px; margin-bottom: 15px; padding: 15px;'>" . printf($conn->error()) . "</div>";
					}

					}
				?>
                <div class="well well-small">
                    <strong>New Blog Post (<a href="blog.php">Go back</a>). </strong><br /><br />
                    <form class="form-horizontal" action="newpost.php" method="POST">
                    <input placeholder="Post Title" style="height: 40px;" type="text" class="input-large" name="post_title"><br /><br />
                    <textarea name="post_content" style="width: 100%; height: 300px; background: #FFF;"></textarea><br />
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

$conn->close();
?>
