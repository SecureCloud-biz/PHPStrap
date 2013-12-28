<?php include '../admin/assets/database.php'; ?>
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
                  PRIMARY KEY (`post_id`)
                ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;");
                    
                $createColumn2 = $conn->query("CREATE TABLE IF NOT EXISTS `users` (
                  `user_id` int(11) NOT NULL AUTO_INCREMENT,
                  `username` varchar(30) NOT NULL,
                  `email` varchar(30) NOT NULL,
                  `password` varchar(30) NOT NULL,
                  `rank_id` text,
                  PRIMARY KEY (`user_id`))");
                   
                if($createColumn) {
                    if($createColumn2) {
                        echo '<div class="well">Database has been written to successfully. Please continue below.</div><a class="btn btn-block btn-primary" href="install-3.php">Continue with installation</a>';
                    } else {
                        echo '<div class="well">Could not create table users:' . printf($conn->error()) . '</div>';
                    }
                } else {
                    echo '<div class="well">Could not crate table posts:' . printf($conn->error()) .'</div>';
                }
            }
            ?>
        </div>
        <div class="span3"></div>
    </div>
</body>
</html>
