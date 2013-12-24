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
    <title>PhpStrap - Manage Users</title>
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
                    All Users<br />
                    <a href="newuser.php">Add New User</a><br />
                    <a href="newadmin.php">Add New Admin</a>
                </div>
            </div>
            <div class="span8">
                <div class="well well-small">
                    <strong>Manage Users.</strong><br /><br />
                    <div class="row-fluid">
                        <div class="span4">
                            <strong>Username</strong>
                        </div>
                        <div class="span6">
                            <strong>Email</strong>
                        </div>
                        <div class="span2">
                            <strong>Edit / Delete</strong>
                        </div>
                    </div>
                    <?php
                    $getusers= $conn->query("SELECT DISTINCT * FROM users ORDER BY user_id DESC")
                    or die(mysql_error()); 
                    
                    while($db_field = $getusers->fetch_array()) {
                    ?>
                    <div class="row-fluid">
                        <div class="span4">
                            <small>(<?php echo $db_field['user_id']; ?>)</small> <?php echo $db_field['username']; ?>
                        </div>
                        <div class="span6">
                            <?php echo $db_field['email']; ?>
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