<?php
include('.\config.php');
include('.\functions.php');

$heading = 'Advance Search';
//show the template file
echo $twig->render('advance_search.html', array( 'heading'=> $heading));

?>
