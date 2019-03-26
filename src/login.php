<?php
// to move to external file

require('../vendor/autoload.php');

// start session to use session variables
session_start();

//meekro db configuration
DB::$user = 'ipd';
DB::$password = "ipdipd";
DB::$dbName = 'librarynorj'; 

// twig configuration
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

  
include ('config.php');
include ('functions.php');
  
	
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger("login");
$log->pushHandler( new StreamHandler("website.log", Logger::DEBUG) );

	if ( $_SERVER['REQUEST_METHOD'] == "POST" ){
		pr($_POST);
		// form submitted
		$log->info("Login Attemp");

		if (isset($_POST['user_name']) && $_POST['user_name'] == ""){
			$error = "Please fill in your user name.";
		}else if (isset($_POST['password']) && $_POST['password'] == ""){
			$error = "Please enter your password.";
		}else {
			// username and password are filled in
			
			//check in database for valid user
		
			$results = DB::queryFirstRow("SELECT UserId, FirstName, LastName, type, password 
															FROM users 
															WHERE username = %s 
															LIMIT 1", $_POST['user_name']);
			
			// check 1 row returned
			if ( $results == null){ // number of rows returned
				$error = "User does not exist";
				$log->warning("User '" . $_POST['user_name'] . "' not found in db");
			}else{
			
				// encrypt pw to match databases
				if ( $results['password'] != md5($_POST['password']) ){ //check if passwords match
					$error = "Passwords do not match";
				}else{
					
					//update our last_login if user found
					
					DB::update('users', array('LastLoginTime'=>DB::sqleval("CURTIME()")), 'UserId=%i', $results['UserId']);
	
					if ( DB::affectedRows() != 1 ){ // number of rows altered by query
						$log->error("Did not update last login");
					}
					
					//save session
					$_SESSION['UserId'] = $results['UserId'];
					$_SESSION['UserName'] = $results['UserName'];
					$_SESSION['UserType'] = $results['UserType'];
					 
					$log->info("user #". $results['UserId'] . " had logged in");
					//redirect user on successful login
          
          
          //header("Location: books.php");
					
				}
			}
    }
  }

 
  echo $twig->render("login.html", 
  array(	"form_action"	=>	$_SERVER['PHP_SELF'], "error" => $error	)
    );
?>
