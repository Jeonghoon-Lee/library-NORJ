<?php
include ('.\config.php');
include ('.\functions.php');

$heading = 'Book Details';
//show the template file
echo $twig->render('booksDetails.html', array( 'heading'=> $heading));

?>