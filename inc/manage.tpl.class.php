<?php
//This file manages the TPL aspects.
//This file can freely be edited to match users needs
//Copyright getphpstrap.com 2014

//Get DB
include 'admin/assets/database.php';
raintpl::configure("base_url", null );
raintpl::configure("tpl_dir", "themes/".$themeset."/" );
raintpl::configure("cache_dir", "tmp/" );
//Start TPL management
$tpl = new RainTPL;
//Basic text management for PhpStrap
$copyright = '&copy; <a href="http://www.getphpstrap.com" target="_blank">PhpStrap</a> 2014';
$tpl->assign( "copyright", $copyright );
//..Sitename
$result = mysqli_query($conn,"SELECT * FROM settings");
while($row = mysqli_fetch_array($result))
{
    $gsitename = $row['sitename'];
    $gbloglimit = $row['bloglimit'];
}
$tpl->assign( "sitename", $gsitename );
//Getblog
$blog_sql = $conn->query("SELECT DISTINCT * FROM posts ORDER BY post_id DESC LIMIT ".$gbloglimit."") or die(mysql_error()); 
while ($db_field = $blog_sql->fetch_array()) {   
    $test[] = $db_field;
}
$tpl->assign( "getblog", $test );
$conn->close();
?>