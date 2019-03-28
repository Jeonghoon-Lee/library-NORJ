<?php
// books.php
  class Search extends Controller {
    // define Model variable
    private $books;

    function __construct() {
      parent::__construct();
      // initialize Models
      $this->books = new BookModel($this->db); 
    }

    function search_book($f3) {
      echo '<h2>Search book Form</h2>';
    }

    function search_result($f3) {
      echo '<h2>Search result list</h2>';
    }

    function get_book_detail($f3) {
      echo '<h2>Get detail book info</h2>';      
    }    
  }
?>
