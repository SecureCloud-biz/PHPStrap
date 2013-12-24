<?php

	//include the RainTPL class
	include "inc/rain.tpl.class.php";
    include "themes/theme-settings.php";
	include "inc/manage.tpl.class.php";

	//initialize the template file
    $template = $tpl->draw( 'index', $return_string = true );
    // and then draw the output
    echo $template;
        
?>