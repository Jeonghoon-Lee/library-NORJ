<?php
include('.\config.php');
include('.\functions.php');
session_start();

database_connect();

$loans = user_loans($_SESSION['UserId']);
$loan_amount = DB::count($loans);
$charges = 0;

$user_loans = DB::query("SELECT * FROM loans WHERE UserId=%i", $_SESSION['UserId']);
for($i=0; $i< sizeof($user_loans); $i++) {
  $charges = $charges + $user_loans[$i]['FineAssessed'] - $user_loans[$i]['FinePaid'] - $user_loans[$i]['FineWaived'];
}

$res = user_res($_SESSION['UserId']);
$res_amount = DB::count($res);

// To update user photo
if ($_SERVER['REQUEST_METHOD'] == "POST"){
 
  if ( isset( $_FILES['image'] ) ){
			// FILES variable exists

			if ( $_FILES['image']['error'] == 0 ){
				//file was successfully uploaded

				// @ suppresses any errors/warnings/notices from a php function
				$extension = strtolower(@end(explode(".", $_FILES['image']['name'])));

				$allowed_extensions = array("png", "gif", "jpg", "jpeg");
				if ( in_array( $extension, $allowed_extensions ) ){
					// file extensions is allowed
				 
//					"UPDATE users set Photo = '" . basename($_FILES['image']['name']) . "' WHERE UserID=%i", $_SESSION['UserId']
					//upload our file
					//if ( move_uploaded_file( $_FILES['image']['tmp_name'], "uploads/" . $_POST['name'] . "." . $extension ) ){
					if ( move_uploaded_file( $_FILES['image']['tmp_name'], "../public/img/" . $_SESSION['UserId']. "." . $extension ) ){
						echo 'aaa' . $db;
            // $insert = $db->query('update users set Photo="aaa" where UserID=1');
            // if($insert){
            //   $error = "The file ".$fileName. " has been uploaded successfully.";
            // }else{
            //   $error = "File upload failed, please try again.";
            // } 
						die(); 
					}else{
						$error = "An error has occured!";
					}
				} else { 
					// file extension is not allowed
					$error = "File must be an image";
				}
			}else{
				//there was an error
				switch( $_FILES['image']['error'] ){
					case 1 :	//UPLOAD_ERR_INI_SIZE
					case 2 : 	//UPLOAD_ERR_FORM_SIZE
						$error = "File size is too big";
						break;
					case 3 :	//UPLOAD_ERR_PARTIAL
					case 4 :	//UPLOAD_ERR_NO_FILE
						$error = "No file uploaded";
						break;
					case 6 :	//UPLOAD_ERR_NO_TMP_DIR
					case 7 :	//UPLOAD_ERR_CANT_WRITE
						$error = "Permission error";
						break;
					case 8 :	//UPLOAD_ERR_EXTENSION
					default :
						$error = "An error has occured!";
				}
			}
    }
	}
	
$user = DB::query("SELECT * FROM users WHERE UserId=%i", $_SESSION['UserId']);

echo $twig->render('user_account.html', array(
                  'session'=>$_SESSION,
                  'loan_amount'=>$loan_amount,
                  'res_amount'=>$res_amount,
                  'charges'=>$charges,
                  "form_action"	=>	$_SERVER['PHP_SELF'],
									"error" => $error,
									"user" => $user
                ));

?>