<?php
include ('.\config.php');
include ('.\functions.php');

$heading = 'Home Page';
//show the template file
echo $twig->render('home.html', array( 'heading'=> $heading));

?>