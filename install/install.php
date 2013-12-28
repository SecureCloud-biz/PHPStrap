<html>
<head>
    <title>PhpStrap | Installer</title>
    <link rel="stylesheet" href="../admin/css/bootstrap.min.css">    
    <link rel="stylesheet" href="../admin/css/extra.css">
    <style type="text/css">
        .input-large {width: 100%;}
    </style>
</head>
<body>
    <br /><div style="text-align: center;"><h4>PhpStrap Beta Installer</h4></div><br />
    <div class="row-fluid">
        <div class="span3"></div>
        <div class="span6">
            <div class="well">
                <strong>Thank you for downloading PhpStrap Beta.</strong><br />
                <p>We hope that PhpStrap will come in very handy for your development if you plan on developing on top of it. This installer will install PhpStrap on to your server. <strong>Please note</strong> that this is an early beta of PhpStrap and we plan on releasing more stable versions of this script in the near future.</p>
                <div style="text-align: center;">
                <a href="http://www.getphpstrap.com/" target="_blank">Official Website</a> -
                <a href="http://www.getphpstrap.com/documentation.html" target="_blank">Documentation</a> -
                <a href="http://www.getphpstrap.com/forum.php" target="_blank">Support Forum</a> -
                <a href="http://www.getphpstrap.com/node.php/v/announcements.2" target="_blank">Check for Updates</a>
                </div>
            </div>
			<?php
				if(isset($_POST['conInstall'])) {
					$installCookie = 1;
					setCookie('installCookie', $installCookie, time() + 60*60*1);
					if(isset($_COOKIE['installCookie'])) {
						header("location: install-2.php");
					}
				}
			?>
            <form method="post" action="">
                <input type="submit" name="conInstall" value="Continue with installtion" class="btn btn-block btn-primary">
            </form>
        </div>
        <div class="span3"></div>
    </div>
</body>
</html>
