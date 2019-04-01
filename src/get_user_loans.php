<?php
include('.\config.php');
include('.\functions.php');
session_start();

//get array of user's loans (array of arrays)
$loans = user_loans($_SESSION['UserId']);

echo json_encode($loans);
  
?>