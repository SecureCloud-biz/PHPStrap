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
	<style type="text/css">
	.input-inputedit {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .input-inputedit {
        margin-bottom: 10px;
      }
      .input-inputedit {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
	  </style>
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
					<?php if(!isset($_GET['edit'])) { ?>
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
                    $getusers= $conn->query("SELECT DISTINCT * FROM users ORDER BY user_id ASC")
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
                            <a href="?edit=<?php echo $db_field['user_id']; ?>"><i class="icon-wrench"></i></a>
                        </div>
                        <div class="span1">
                            <a href="?delete=<?php echo $db_field['user_id']; ?>"><i class="icon icon-remove-sign"></i></a>
                        </div>
                    </div>
                    <?php
                    }
						} elseif(isset($_GET['edit'])) { 
							$eId = $conn->real_escape_string($_GET['edit']);
							$readyEdit = $conn->query("SELECT * FROM users WHERE user_id = '".$eId."'");
							while($fetchEdit = $readyEdit->fetch_array()) {
					?>
					
					Edit: <b><?php echo $fetchEdit['username']; ?></b><br /><br />
					
					<form method="post" action="">
						<label for="editUsr">Username</label>
						<input type="text" name="editUsr" value="<?php echo $fetchEdit['username']; ?>" style="padding: 15px; width: 100%;">

						<label for="editMail">Email</label>
						<input type="text" name="editMail" value="<?php echo $fetchEdit['email']; ?>" style="padding: 15px; width: 100%;">
						
						<label for="editRank">Rank</label>
						<input type="text" name="editRank" value="<?php echo $fetchEdit['rank_id']; ?>" style="padding: 15px; width: 100%;">
						
						<input type="submit" name="submitEdit" value="Save" class="btn btn-success">
					</form>
					
					<?php
						}
						
						if(isset($_POST['submitEdit'])) { 
							$newUsername = $conn->real_escape_string($_POST['editUsr']);
							$newEmail = $conn->real_escape_string($_POST['editMail']);
							$newRank = $conn->real_escape_string($_POST['editRank']);
							
							$updateUsers = $conn->query("UPDATE users SET username = '".$newUsername."', email = '".$newEmail."', rank_id = '".$newRank."' WHERE user_id = '".$eId."'");
							if($updateUsers) {
								header("location: users.php");
							}
						}
						
						if($readyEdit->num_rows <= 0) {
							header("location: users.php");
						}
						
					}
					
					if(isset($_GET['delete'])) {
						$eId = $conn->real_escape_string($_GET['delete']);
						
						$deleteUser = $conn->query("DELETE FROM users WHERE user_id = '".$eId."'");
						
						if($deleteUser) {
							header("location: users.php");
						}
						
						$controlEx = $conn->query("SELECT * FROM users WHERE user_id = '".$eId."'");
						
						if($controlEx->num_rows <= 0) {
							header("location: users.php");
						}
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
