<?php
include('.\config.php');
include('.\functions.php');
session_start();

$loans = user_loans($_SESSION['UserId']);
$loan_amount = DB::count($loans);

for($i=0; $i< sizeof($loans); $i++) {
  $charges = $loans[$i]['FineAssessed'];
}

$res = user_res($_SESSION['UserId']);
$res_amount = DB::count($res);

 

echo $twig->render('user_account.html', array(
                  'session'=>$_SESSION,
                  'loan_amount'=>$loan_amount,
                  'res_amount'=>$res_amount,
                  'charges'=>$charges));

?>