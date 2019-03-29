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
      echo $f3->get('twig')->render('search.html');
    }

    function search_result($f3) {
      $search_option = array(
        'books' => $this->books->fetch_all()
      );
      echo $f3->get('twig')->render('search_result.html', $search_option);
    }

    function get_detail($f3) {
      $ISBN = $f3->get('PARAMS.ISBN');    // get ISBN     
      $book = $this->books->find_by_isbn($ISBN);

      echo $f3->get('twig')->render('book_detail.html', array('book' => $book));
    }    
  }
?>
