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
    $db = new mysqli('localhost', 'ipd', 'ipdipd','ipd16');

    //check for connection errors
    if ( $db->connect_errno > 0){
        echo 'Connection failed' . $db->connect_error;
        die();
    }
}

// to check if user is logged in
function checked_in(){
  if (isset($_SESSION['UserId']) && $_SESSION['UserId'] != ''){
      return true;
      }else{
          return false;
      }
}

?>
