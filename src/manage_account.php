<?php
include('.\config.php');
include('.\functions.php');
session_start();

echo $twig->render('user_account.html', array(
                  'session'=>$_SESSION));

?>