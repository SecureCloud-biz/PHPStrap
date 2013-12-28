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
$result = $conn->query("SELECT * FROM settings");
while($row = $result->fetch_array())
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
// Get blog page
$blog_page = $conn->query("SELECT * FROM posts ORDER BY post_id DESC LIMIT 10");
$result = $blog_page->fetch_array();

$last = $conn->real_escape_string($result['post_id']);

if(isset($_GET['id'])) {
	$blog_viewid = $conn->real_escape_string($_GET['id']);
} else {
	$blog_viewid = $last;
}

$getBlogInfo = $conn->query("SELECT * FROM posts WHERE post_id = '".$blog_viewid."'");
$blogsview = $getBlogInfo->fetch_array();

$tpl->assign("blogsview", $blogsview);
//Managing logged in users
if (isset($_SESSION['logged'])) { 
    if ($_SESSION['logged'] == 1) {
        $c_username = $_SESSION['username'];
        $result = $conn->query("SELECT * FROM users where username = '".$c_username."'");
        while($row = $result->fetch_assoc()) {
            $user_id = $row['user_id'];
            $rank_id = $row['rank_id'];
            $username = $row['username'];
        }
        $tpl->assign( "user_id", $user_id );
        $tpl->assign( "rank_id", $rank_id );
        $tpl->assign( "username", $username );
    }
}
//Check logged


$conn->close();
?>
