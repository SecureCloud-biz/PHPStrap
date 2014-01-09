<?php
//This file manages the TPL aspects.
//This file can freely be edited to match users needs
//Copyright getphpstrap.com 2014

//Get DB
include 'admin/assets/database.php';
include 'themes/theme-settings.php';
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
while($db_field = $blog_sql->fetch_array()) {
        $test[] = $db_field;
        $tpl->assign( "getblog", $test );
}

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

if(isset($_GET['id'])) {
        if($getBlogInfo->num_rows <= 0) {
                header("location: blog.php");
        }
}

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

// Blog comments
if(isset($_POST['submitComment'])) {
        $blogComment = $conn->real_escape_string($_POST['blogComment']);
        
        if(!empty($blogComment)) {
                $blogId = $conn->real_escape_string($_GET['id']);
                $BlogUid = $conn->real_escape_string($username);
                $blogDate = date("d/m/Y H:i");
                
                $insertComment = $conn->query("INSERT INTO post_comments (post_id, user_name, comment, date) VALUES('".$blogId."', '".$BlogUid."', '".$blogComment."', '".$blogDate."')");
                if($insertComment) {
                        header("location: blog.php?id=$blogId");
                } else {
                        printf($conn->error());
                }
        } else {
                $commentSign = "You can't leave the comment blank.";
                $tpl->assign("commentSign", $commentSign);
        }
}

// Show blog comments
if(isset($_GET['id'])) { 
        $cId = $conn->real_escape_string($_GET['id']);
        $showBlogComments = $conn->query("SELECT * FROM post_comments WHERE post_id = '".$cId."' ORDER BY id");
        while($fetchBlogComments = $showBlogComments->fetch_array()) {
                $bComment[] = $fetchBlogComments;
                $tpl->assign("getComments", $bComment);
        }
        
        if(isset($_GET['reply'])) {
                $rId = $conn->real_escape_string($_GET['reply']);
                $tryRpl = $conn->query("SELECT * FROM post_comments WHERE id = '".$rId."'");
                $fetchTryRpl = $tryRpl->fetch_array();
                
                $tpl->assign("fetchTryRpl", $fetchTryRpl);
        }
}

//Blog Likes
if(isset($_GET['id'])) {
        if(isset($_SESSION['logged'])) {
                if(isset($_POST['like'])) {
                        $addLike = $conn->query("UPDATE posts SET likes = likes + 1 WHERE post_id = '".$cId."'");
                        $addLock = $conn->query("INSERT INTO post_likes (user_id, post_id) VALUES('".$user_id."', '".$cId."')");
                } elseif(isset($_POST['unlike'])) {
                        $removeLike = $conn->query("UPDATE posts SET likes = likes - 1 WHERE post_id = '".$cId."'");
                        $removeLock = $conn->query("DELETE FROM post_likes WHERE user_id = '".$user_id."' AND post_id = '".$cId."'");
                }
                
                
                $checkLock = $conn->query("SELECT * FROM post_likes WHERE user_id = '".$user_id."' AND post_id = '".$cId."'");
                $controlLock = $checkLock->num_rows;
                
                
                $tpl->assign("controlLock", $controlLock);
        }
        
        $countLikes = $conn->query("SELECT * FROM post_likes WHERE post_id = '".$cId."'");
        $getLikes = $countLikes->num_rows;
        $tpl->assign("getLikes", $getLikes);
}
// Delete blog comments
if(isset($_GET['id'])) {
        if(isset($_GET['delComment'])) {
                if($rank_id == 7) {
                        $delId = $conn->real_escape_string($_GET['delComment']);
                        $delCommentQuery = $conn->query("DELETE FROM post_comments WHERE id = '".$delId."'");
                        if($delCommentQuery) {
                                header("location: blog.php?id=" . $conn->real_escape_string($_GET['id']) . "");
                        }
                } else {
                        header("location: blog.php");
                }
        }
}
//Check logged


$conn->close();
?>