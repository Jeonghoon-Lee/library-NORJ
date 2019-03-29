<?php
  function pr($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
  }

  // global variables
//  $error = '';
  $error = array();   // set as array variable.
 
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
  $u_loans = DB::query("SELECT LoanID, ISBN, UserID, DateOut, DateDue, FineAssessed FROM loans WHERE UserId=%i", $u_id);
  
  //$loan_info = array_push_assoc($loan_info, 'Title', $book['Title']);
  //$loan_info = array_merge($book,$u_loans);
  return $u_loans;   
}

function get_book_by_ISBN($b_isbn) {
  $book = DB::query("SELECT Title, ISBN FROM books WHERE ISBN=%i", $b_isbn);
  return $book;
}

function user_res($u_id) {
  $reservations = DB::query("SELECT * FROM reservations WHERE UserId=%i", $u_id);
  return $reservations; 
}

?>
