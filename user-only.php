<?php
    //To make this page User-Only:
    session_start();
    if (isset($_SESSION['logged'])) { 
        if ($_SESSION['logged'] == 1) {
    //END - USERS THAT ARE LOGGED IN SEE THIS
            
            //include the RainTPL class
            include "inc/rain.tpl.class.php";
            include "themes/theme-settings.php";
            include "inc/manage.tpl.class.php";
        
            //initialize the template file
            $template = $tpl->draw( 'user-only', $return_string = true );
            // and then draw the output
            echo $template;
            
    //START - CLOSE THE BRACKETS
        }
    } else {
            echo "This page seems to be using the 'users-only' PHP template in the root of your install. To log in click <a href='user/ps-login.php'>here</a>."; //NON-USERS SEE THIS
    }
    //END
?>