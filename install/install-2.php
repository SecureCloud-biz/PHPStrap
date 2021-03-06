<?php include '../admin/assets/database.php'; ?>
<?php if(isset($_COOKIE['installCookie'])) { ?>
<html>
<head>
    <title>PhpStrap | Installer</title>
    <link rel="stylesheet" href="../admin/css/bootstrap.min.css">    
    <link rel="stylesheet" href="../admin/css/extra.css">
    <style type="text/css">
        .input-large {width: 100%;}
    </style>
</head>
<body>
    <br /><div style="text-align: center;"><h4>PhpStrap Beta Installer</h4></div><br />
    <div class="row-fluid">
        <div class="span3"></div>
        <div class="span6">
            <div class="well">
                <strong>Please fill in the database credentials.</strong><br /><br />
                <p>This page will automatically insert all the data into your database provided the correct information has been set in '../admin/assets/database.php'.</p>
                <form class="form-horizontal" action="install-2.php" method="POST">
					<button type="submit" value="submit" name="submit" class="btn btn-block btn-success">Insert data into database</button>
					<input type="hidden" name="conInstall2">
                </form>
            </div>
            <?php
            //Get info
            if(isset($_POST['submit'])){
                // Establish connection and insert
                $createColumn = $conn->query("CREATE TABLE IF NOT EXISTS `posts` (
                  `post_id` int(11) NOT NULL AUTO_INCREMENT,
                  `dateposted` varchar(25) NOT NULL,
                  `author_id` int(11) NOT NULL,
                  `post_title` text NOT NULL,
                  `post_content` text NOT NULL,
				  `likes` int(11) NOT NULL,
                  PRIMARY KEY (`post_id`)
                ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;");
                    
                $createColumn2 = $conn->query("CREATE TABLE IF NOT EXISTS `users` (
                  `user_id` int(11) NOT NULL AUTO_INCREMENT,
                  `username` varchar(255) NOT NULL,
                  `email` varchar(255) NOT NULL,
                  `password` varchar(255) NOT NULL,
                  `rank_id` text,
                  PRIMARY KEY (`user_id`))");
				
				$createColumn3 = $conn->query("CREATE TABLE IF NOT EXISTS `settings` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `sitename` varchar(255) NOT NULL,
				  `siteemail` varchar(255) NOT NULL,
				  `bloglimit` varchar(255) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;");
				
				$createData3 = $conn->query("INSERT INTO `settings` VALUES ('1', 'PHPStrap', 'admin@admin.com', '5')");
				
				$createColumn4 = $conn->query("CREATE TABLE IF NOT EXISTS `post_likes` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `user_id` int(11) NOT NULL,
				  `post_id` int(11) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
				
				$createColumn5 = $conn->query("CREATE TABLE IF NOT EXISTS `post_comments` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `post_id` int(11) NOT NULL,
					  `user_name` varchar(255) NOT NULL,
					  `comment` text NOT NULL,
					  `date` varchar(255) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
								   
                if($createColumn) {
                    if($createColumn2) {
						if($createColumn3) {
							if($createColumn4) {
								if($createColumn5) { 
									setCookie('installCookie', $installCookie, time() -3600);
									unset($_COOKIE['installCookie']);
									
									$installCookie2 = 1;
									setCookie('installCookie2', $installCookie2, time() + 60*60*1);
									
									if(isset($_COOKIE['installCookie2'])) {
										header("location: install-3.php");
									} 
								} else {
									echo '<div class="well">Could not create table post_comments:' . $conn->error . '</div>';
								}
							} else {
								echo '<div class="well">Could not create table post_likes:' . $conn->error . '</div>';
							}
						} else {
							echo '<div class="well">Could not create table settings:' . $conn->error . '</div>';
						}
                    } else {
                        echo '<div class="well">Could not create table users:' . $conn->error . '</div>';
                    }
                } else {
                    echo '<div class="well">Could not create table posts:' . $conn->error .'</div>';
                }
            }
            ?>
        </div>
        <div class="span3"></div>
    </div>
</body>
</html>
<?php } else { header("location: install.php"); } ?>
