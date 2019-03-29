<?php
include('.\config.php');
include('.\functions.php');
session_start();

//get array of user's loans (array of arrays)
$res = user_res($_SESSION['UserId']);

for($i=0; $i< sizeof($res); $i++) {
  // get book title for each reservation by querying DB, pass ISBN as argument
  $book_title = get_book_by_ISBN($res[$i]['ISBN']);
  //push title to reservation
  array_push($res[$i], $book_title[0]['Title']);
  //set key "Title" 
  foreach($res[$i] as $key => $value) {
    $newkey = "Title";
    $res[$i][$newkey] = $value;
    unset($res[$i][0]);
  }
}

echo json_encode($res);
  
?>