<?php
  function pr($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
  }

  // global variables
//  $error = '';
  $error = '';   // set as array variable.
 
  $categories = '';
  $languages = '';

  
  function get_category_list() {
    $categories = DB::query('SELECT * FROM Categories');
  }

  function get_language_list() {
    $languages = DB::query('SELECT * FROM Languages');
  }

  $db; 
  
  //global database object

function database_connect(){
    global $db;
                        //server, user, password, database(optional)
    $db = new mysqli('localhost', 'ipd', 'ipdipd','librarynorj');

    //check for connection errors
    if ( $db->connect_errno > 0){
        echo 'Connection failed' . $db->connect_error;
        die();
    }
}

// to check if user is logged in
function logged_in(){
  if (isset($_SESSION['UserId']) && $_SESSION['UserId'] != ''){
      return true;
      }else{
          return false;
      }
}


function user_loans($u_id) {
  $u_loans = DB::query("SELECT Title, DateOut, DateDue FROM loan_user_view WHERE Datein is null and UserId=%i", $u_id);
  return $u_loans;   
}


function user_res($u_id) {
  $reservations = DB::query("SELECT ReservID, Title, ReservDate, ReservStatus FROM reserve_user_view WHERE UserId=%i", $u_id);
  return $reservations; 
}

?>
