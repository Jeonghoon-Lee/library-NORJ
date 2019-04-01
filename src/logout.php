<?php
//logout.php
//resset session variables
//redirect to login

session_start();
session_unset(); //$_session = array();
session_destroy(); //kills the session;

header('Location: login.php');
?>