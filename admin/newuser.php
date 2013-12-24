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
    <title>PhpStrap - Add New User</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">    
    <link rel="stylesheet" href="css/extra.css">
    <style type="text/css">
        .input-large {width: 100%;}
    </style>
</head>
<body>
    <?php include 'inc/navigation.php'; ?>
    <div class="container">
        <div class="row-fluid">
            <div class="span4">
                <div class="well well-small">
                    <strong>Sub-Directories</strong><br />
                    <a href="users.php">All Users</a><br />
                    Add New User<br />
                    <a href="newadmin.php">Add New Admin</a>
                </div>
            </div>
            <div class="span8">
                <div class="well well-small">
                    <strong>Add New User.</strong><br /><br />
                    <form class="form-horizontal" action="newuser.php" method="POST">
                    <input placeholder="Username" style="height: 40px;" type="text" class="input-large" name="username"><br /><br />
                    <input placeholder="Email" style="height: 40px;" type="text" class="input-large" name="email"><br /><br />
                    <input placeholder="Password" style="height: 40px;" type="password" class="input-large" name="password"><br /><br />
                    <button type="submit" value="submit" name="submit" class="btn btn-block btn-success">Add New User</button>
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
$username = $_POST['username'];
$email = $_POST['email'];
$rank_id = '1';
$password = md5($_POST['password']);

$conn->query("INSERT INTO users (username, email, rank_id, password) VALUES (
'" . mysql_real_escape_string($username) . "',
'" . mysql_real_escape_string($email) . "',
'" . mysql_real_escape_string($rank_id) . "',
'" . mysql_real_escape_string($password) . "')");
    
header("Location: newuser.php");

    
}

$conn->close();
?>