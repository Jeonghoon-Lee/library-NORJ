<?php
include('.\config.php');
include('.\functions.php');
session_start();

$loans = user_loans($_SESSION['UserId']);

echo json_encode($loans);

?>