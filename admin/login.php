<?php

include 'assets/database.php';
session_start();

if (isset($_SESSION['logged'])) { 
    if ($_SESSION['logged'] == 1) {
        header("Location: dashboard.php");
    }
}
?>
<html>
<head>
    <title>PhpStrap - Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">    
    <link rel="stylesheet" href="css/extra.css">  
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
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
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
</head>
<body>
    <div class="container">
      <form class="form-signin" action="login.php" method="post">
          <h4>PhpStrap Login</h4>
        <input type="text" name="username" class="input-block-level" placeholder="Username">
        <input type="password" name="password" class="input-block-level" placeholder="Password">
        <button class="btn btn-block btn-success" name="submit" value="submit" type="submit">Sign in</button>
      </form>
        <div style="text-align: center;font-size: small;">Powered by <a href="http://www.getphpstrap.com/" target="_blank">PhpStrap</a></div>
    </div>
</body>
</html>
<?php
if(isset($_POST['submit'])){
    $input['username'] = htmlentities($_POST['username'], ENT_QUOTES);
    $input['password'] = htmlentities($_POST['password'], ENT_QUOTES);
    $hash = md5($input['password']);
                    
    if ($stmt = $conn->prepare("SELECT username, password FROM users WHERE username=? AND password=?"))
    {
        $stmt->bind_param("ss", $input['username'], $hash);
        $stmt->execute();
        $stmt->bind_result($username, $hash);
        $stmt->store_result();
        
        if ($stmt->num_rows == 1)
        {
            if($stmt->fetch())
            {
                $_SESSION['username'] = $input['username'];
                $_SESSION['logged'] = 1;
                header("Location: login.php");
            }
        }
    } else {
        echo "<br /><form class=\"form-signin\"><div style=\"text-align: center;\">Error: failed to log you in!</div></form>";
    }
}
$conn->close();
?>