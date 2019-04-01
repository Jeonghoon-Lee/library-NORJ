<?php
include ('.\config.php');
include ('.\functions.php');

//$books = DB::query("SELECT * FROM books");
$heading = 'New Releases';

$new_books = DB::query("SELECT * FROM books ORDER BY Year LIMIT 6");

//pr($new_books);

echo $twig->render("new_releases.html", array("books"=>$new_books, "heading" => $heading));
?>