<?php
    if (file_exists('install')) { //Checks to see if install file exists
        header("Location: /install"); //If it does, it redirects to the install file
    } else {

	//include the RainTPL class
	include "inc/rain.tpl.class.php";
    include "themes/theme-settings.php";
	include "inc/manage.tpl.class.php";

	//initialize the template file
    $template = $tpl->draw( 'index', $return_string = true );
    // and then draw the output
    echo $template;
    
    }
        
?>