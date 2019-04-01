<?php
include('.\config.php');
include('.\functions.php');


$button_text = "Create";
$title = "Create Account";
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
$id = $u_name = $passw = $f_name = $m_name = $l_name = $u_type = $email = $b_date = '';


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
  }else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $error = "Please enter a valid email.";
  }else if (isset($_POST['passw']) && $_POST['passw'] == ""){
    $error = "Please enter your password.";
  }else if (strlen($_POST['passw']) < 7) {
    $error = "Password is too short. Password should be at least 7 characters.";
  }else if (strlen($_POST['passw']) > 15) {
    $error = "Password is too long. Password should be at most 15 characters.";
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
  
  //IF NO ERRORS
    if (empty($error)){
      $dob = "";
      $dob = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
      $dob_date = DateTime::createFromFormat("Y-F-j", $dob);
      
      $new_user = array(
        'UserName' => $_POST['user_name'],
        'Password' => md5($_POST['passw']),
        'FirstName' => $_POST['first_name'],
        'MiddleName' => $_POST['middle_name'],
        'LastName' => $_POST['last_name'],
        'UserType' => 'user',
        'Email' => $_POST['email'],
        'BirthDate' => $dob_date->format('Y-m-d'),
        'RegisteredDate' => date('Y-m-d'),
        'LastLoginTime' => null,
        'Photo' => null
      );
      if (isset($_POST['user_id']) && is_numeric($_POST['user_id']))
      $new_user['UserID'] = $_POST['user_id'];
      //insert data into users table
      DB::insertUpdate("users", $new_user);

      /*if ( DB::affectedRows() != 1 ){ // number of rows altered by query
        $log->error("Did not save a user.");
      } */
      $results = DB::queryFirstRow("SELECT UserId, FirstName, LastName, UserType, password 
                                FROM users 
                                WHERE username = %s 
                                LIMIT 1", $_POST['user_name']);
      
      session_start(); 
      $_SESSION['UserId'] = $results['UserId'];
      $_SESSION['UserId'] = $results['UserId'];
      $_SESSION['FirstName'] = $results['FirstName'];
      $_SESSION['LastName'] = $results['LastName'];
      $_SESSION['UserType'] = $results['UserType'];
      
      header("Location: manage_account.php");
      
    }
  }
  // GET method
} else {
  
	if (isset($_GET['user_id']) && is_numeric($_GET['user_id'])){
		$user =  DB::queryFirstRow("SELECT * FROM users WHERE UserID=%i", $_GET['user_id']);
		if (DB::count() != 0){
      $id = $user['UserID'];
      $u_name = $user['UserName'];
      $passw = $user['Password'];
      $f_name = $user['FirstName'];
      $m_name = $user['MiddleName'];
      $l_name = $user['LastName'];
      $u_type = $user['UserType'];
      $email = $user['Email'];
      $b_date = $user['BirthDate'];

      $title = "Edit Account";
      $button_text = "Edit";
    }
  }
}

$users = array('UserID' => $id,
              'UserName' => $u_name,
              'Password' => $passw,
              'FirstName' => $f_name, 
              'MiddleName' => $m_name, 
              'LastName' => $l_name, 
              'UserType' => $u_type, 
              'Email' => $email, 
              'BirthDate' => $b_date
            );

echo $twig->render("create_user.html", 
      array(	"form_action"	=>	$_SERVER['PHP_SELF'], "error" => $error,
      "min_year" => $min_year, "cur_year" => $cur_year, "months" => $months,
      "post" => $_POST, "user"=>$users, "title"=>$title, "button" => $button_text));
?>