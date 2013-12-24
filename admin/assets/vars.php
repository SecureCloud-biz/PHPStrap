<?php
//General Script Variables
$pstrapv = "0.8";
$c_username = $_SESSION['username'];

//Fetch User Information From Database
$result = $conn->query("SELECT * FROM `users` where username = '".$c_username."'");
 while($row = $result->fetch_assoc()) {
     $user_id = $row['user_id'];
     $rank_id = $row['rank_id'];
     $user_name = $row['username'];
 }


//Fetch Statistics
    //Fetch how many users
$hmusers = $conn->prepare("SELECT * FROM users");
$hmusers->execute();
$hmusers->store_result();

$numofusers = $hmusers->num_rows;

    //Fetch how many blog posts
$hmposts = $conn->prepare("SELECT * FROM posts");
$hmposts->execute();
$hmposts->store_result();

$numofposts = $hmposts->num_rows;
?>