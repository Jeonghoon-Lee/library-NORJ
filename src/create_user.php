<?php
include('.\config.php');
include('.\functions.php');

session_start();

$min_year = 1920;
$cur_year = 2019;
$months = array(
  'January',
  'February',
  'March',
  'April',
  'May',
  'June',
  'July ',
  'August',
  'September',
  'October',
  'November',
  'December',
);
$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 

if ( $_SERVER['REQUEST_METHOD'] == "POST" ){
		
  // form submitted
  
  if (isset($_POST['first_name']) && $_POST['first_name'] == ""){
    $error = "Please fill in your first name.";
  }else if (is_numeric($_POST['first_name'])) {
    $error = "Please enter a valid first name.";
  }else if (is_numeric($_POST['middle_name'])) {
    $error = "Please enter a valid middle name.";
  }else if (isset($_POST['last_name']) && $_POST['last_name'] == ""){
    $error = "Please fill in your last name.";
  }else if (is_numeric($_POST['last_name'])) {
    $error = "Please enter a valid last name.";


    //TO DO check if user name already exists
  }else if (isset($_POST['user_name']) && $_POST['user_name'] == ""){
    $error = "Please fill in your user name.";
  }else if (isset($_POST['email']) && $_POST['email'] == ""){
    $error = "Please fill in your email.";


    //TO DO validate email
  //}else if (preg_match($regex, $_POST['email'])) {
    //$error = "Please enter a valid email.";
  }else if (isset($_POST['passw']) && $_POST['passw'] == ""){
    $error = "Please enter your password.";
  }else if (strlen($_POST['passw']) <= 6) {
    $error = "Password is too short.";
  }else if (strlen($_POST['passw']) > 15) {
    $error = "Password is too long.";
  }else if ($_POST['passw'] !== ($_POST['passw_c'])) {
    $error = "Passwords don't match.";
  }else if (isset($_POST['day']) && $_POST['day'] == "") {
    $error = "Please enter your Date of Birth.";
  }else if (isset($_POST['month']) && $_POST['month'] == ""){
    $error = "Please enter your Date of Birth.";
  }else if (isset($_POST['year']) && $_POST['year'] == ""){
    $error = "Please enter your Date of Birth.";
  }else {
    // data filled in
  
  //IF I HAVE NO ERRORS
	if (empty($error)){
    $dob = strtotime($_POST['year'].'/'.$_POST['month'].'/'.$_POST['day']);
    $dob_date = date('Y-m-d', $dob);
    
    
		$new_user = array(
      'UserName' => $_POST['user_name'],
      'Password' => md5($_POST['passw']),
      'FirstName' => $_POST['first_name'],
      'MiddleName' => $_POST['middle_name'],
      'LastName' => $_POST['last_name'],
      'UserType' => 'user',
      'Email' => $_POST['email'],
      'BirthDate' => $dob_date,
      'RegisteredDate' => date('Y-m-d'),
      'LastLoginTime' => null,
      'Photo' => null
		);
    
		//insert data into books table
    DB::insert("users", $new_user);
    
    /*if (DB::count() != 1) {
      echo "DB not updated";
    }*/
		
    //header("Location: books.php");
  }
  }
}

echo $twig->render("create_user.html", 
      array(	"form_action"	=>	$_SERVER['PHP_SELF'], "error" => $error,
      "min_year" => $min_year, "cur_year" => $cur_year, "months" => $months));
?>