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
    <title>PhpStrap - Add New Admin</title>
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
                    <a href="newuser.php">Add New User</a><br />
                    Add New Admin
                </div>
            </div>
            <div class="span8">
				<?php
					//Inserting Admin to Database
					if(isset($_POST['submit'])){
					$username = $conn->real_escape_string($_POST['username']);
					$email = $conn->real_escape_string($_POST['email']);
					$rank_id = '7';
					$password = $conn->real_escape_string(md5($_POST['password']));

					$addAdmin = $conn->query("INSERT INTO users (username, email, rank_id, password) VALUES (
					'" . $username . "',
					'" . $email . "',
					'" . $rank_id . "',
					'" . $password . "')");

					if($addAdmin) {
						echo "<div style='background: green; color:#FFF; border-radius:4px; margin-bottom: 15px; padding: 15px;'>The admin was successfully added.</div>";
					} else {
						echo "<div style='background: red; color:#FFF; border-radius:4px; margin-bottom: 15px; padding: 15px;'>". printf($conn->error()) . "</div>";
					}

					}
				?>
                <div class="alert alert-info">
                  <strong>Notice:</strong> This page is for adding new administrators. Use at own risk.
                </div>
                <div class="well well-small">
                    <strong>Add New Admin.</strong><br /><br />
                    <form class="form-horizontal" action="newadmin.php" method="POST">
                    <input placeholder="Username" style="height: 40px;" type="text" class="input-large" name="username"><br /><br />
                    <input placeholder="Email" style="height: 40px;" type="text" class="input-large" name="email"><br /><br />
                    <input placeholder="Password" style="height: 40px;" type="password" class="input-large" name="password"><br /><br />
                    <button type="submit" value="submit" name="submit" class="btn btn-block btn-success">Add New Admin</button>
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
