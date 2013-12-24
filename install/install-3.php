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
                <strong>Please fill in the administrator credentials.</strong><br /><br />
                <form class="form-horizontal" action="install-3.php" method="POST">
                <input placeholder="Username" style="height: 40px;" type="text" class="input-large" name="username"><br /><br />
                <input placeholder="Email" style="height: 40px;" type="text" class="input-large" name="email"><br /><br />
                <input placeholder="Password" style="height: 40px;" type="password" class="input-large" name="password"><br /><br />
                <button type="submit" value="submit" name="submit" class="btn btn-block btn-success">Install</button>
                </form>
            </div>
            <?php
            //Getinfo
            if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            //establish connection and insert
                $conn->query("INSERT INTO posts (post_id, dateposted, author_id, post_title, post_content`) VALUES
            (1, 20/11/13, 1, Hello World!, This is your first PhpStrap Post! Log in to the administration panel to edit or delete this post.),");
            $conn->query("INSERT INTO users (user_id, username, email, password, rank_id) VALUES
            (1, ".$username.", ".$email.", ".$password.", 7)");
            
            echo '
            <div class="well"><strong>PhpStrap has successfully been installed.</strong> Please delete the install folder to be able to run the script.</div>';
            
                
            }
            ?>
        </div>
        <div class="span3"></div>
    </div>
</body>
</html>