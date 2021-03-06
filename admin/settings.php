<?php

include 'assets/database.php';
session_start();
include 'assets/vars.php';
//Checks to see if the user is able to login to the dashboard.
if (!isset($_SESSION['logged'])) { header("Location: login.php"); }
if ($rank_id == 7) {
$result = mysqli_query($conn,"SELECT * FROM settings");

while($row = mysqli_fetch_array($result))
  {
  $gsitename = $row['sitename'];
  $gsiteemail = $row['siteemail'];
  $gbloglimit = $row['bloglimit'];
  }
?>
<html>
<head>
    <title>PhpStrap - General Settings</title>
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
                    General Settings<br />
                </div>
            </div>
            <div class="span8">
                <div class="well well-small">
                    <strong>General Settings.</strong><br /><br />
                    <form class="form-horizontal" action="settings.php" method="POST">
                        <label>Site name</label>
                    <input value="<?php echo $gsitename; ?>" style="height: 40px;width: 100%;" type="text" class="input-large" name="sitename"><br /><br />
                        <label>Site email</label>
                    <input value="<?php echo $gsiteemail; ?>" style="height: 40px;width: 100%;" type="text" class="input-large" name="siteemail"><br /><br />
                        <label>How many blog posts should show on blog.php</label>
                    <input value="<?php echo $gbloglimit; ?>" style="height: 40px;width: 100%;" type="text" class="input-large" name="bloglimit"><br /><br />
                    <button type="submit" value="submit" name="submit" class="btn btn-block btn-success">Save settings</button>
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
if(isset($_POST['submit'])){
$sitename = $conn->real_escape_string($_POST['sitename']);
$siteemail = $conn->real_escape_string($_POST['siteemail']);
$bloglimit = $conn->real_escape_string($_POST['bloglimit']);

$conn->query("UPDATE settings SET sitename='".$sitename."', siteemail='".$siteemail."', bloglimit='".$bloglimit."' WHERE id='1'");
    
header("Location: settings.php");

    
}
$conn->close();
?>
