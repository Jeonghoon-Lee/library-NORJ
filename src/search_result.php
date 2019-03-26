<?php
include ('.\config.php');
include ('.\functions.php');

$books = DB::query("SELECT * FROM books");
$heading = 'Search results';
//show the template file
echo $twig->render('search_result.html', array('books'=>$books, 'heading'=> $heading));

?>