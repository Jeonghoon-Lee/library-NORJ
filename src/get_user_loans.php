<?php
include('.\config.php');
include('.\functions.php');
session_start();

//get array of user's loans (array of arrays)
$loans = user_loans($_SESSION['UserId']);

for($i=0; $i< sizeof($loans); $i++) {
  // get book title for each loan by querying DB, pass ISBN as argument
  $book_title = get_book_by_ISBN($loans[$i]['ISBN']);
  //push title to loan
  array_push($loans[$i], $book_title[0]['Title']);
  //set key "Title" 
  foreach($loans[$i] as $key => $value) {
    $newkey = "Title";
    $loans[$i][$newkey] = $value;
    unset($loans[$i][0]);
  }
}

echo json_encode($loans);
  
?>