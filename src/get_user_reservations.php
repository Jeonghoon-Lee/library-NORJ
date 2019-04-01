<?php
include('.\config.php');
include('.\functions.php');
session_start();

//get array of user's loans (array of arrays)
$res = user_res($_SESSION['UserId']);

echo json_encode($res);
  
?>