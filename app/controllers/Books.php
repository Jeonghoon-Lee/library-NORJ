<?php
// books.php
  class Books extends Controller {
    // define Model variable
    private $books;
    private $languages;
    private $categories;

    function __construct() {
      parent::__construct();
      // initialize Models
      $this->books = new BookModel($this->db);
      $this->languages = new LangModel($this->db);
      $this->categories = new CategoryModel($this->db);
  
    }

    function check_validation() {
      //
      // need to implement validation
      //
      return true;
    }

    // create form to register a new book
    function create_form($f3) {
      $render_option = array(
        'url' => 'book/create',
        'subtitle' => 'Create Book',
        'languages' => $this->languages->fetch_all(),
        'categories' => $this->categories->fetch_all()
      );      
      echo $f3->get('twig')->render('form_book_create.html', $render_option);
    }

    // insert a new book information to the books table in DB
    function add_new_book($f3) {
      if ($this->check_validation()) {
        $this->books->add_book();
      } else {
        echo 'error message';
      }
    }

    // create the book update form
    function update_form($f3) {
      // testing
      // echo $f3->get('PARAMS.ISBN');
      $search_option = array('ISBN = ?', $f3->get('PARAMS.ISBN'));
      $book = $this->books->find_book($search_option);

      if (count($book) == 1) {
        $render_option = array(
          'url' => 'book/update/'.$f3->get('PARAMS.ISBN'),
          'subtitle' => 'Update Book',
          'book' => $book[0], 
          'languages' => $this->languages->fetch_all(),
          'categories' => $this->categories->fetch_all()
        );
        echo $f3->get('twig')->render('form_book_create.html', $render_option);
      } else {
        echo 'No book found';
      }
    }

    // update the book information by ISBN
    function update_book($f3) {
      $search_option = array('ISBN = ?', $f3->get('PARAMS.ISBN'));
      if ($this->check_validation()) {
        $this->books->update_book($search_option);
      } else {
        echo 'error message';
      }
    }

    // delete book from books table
    function delete_book($f3) {
      $search_option = array('ISBN = ?', $f3->get('PARAMS.ISBN'));
      $this->books->delete_book($search_option);
    }

    // display book list
    function book_list($f3) {
      $book_list = $this->books->fetch_all();
      echo sizeof($book_list);

      echo $f3->get('twig')->render('book_list.html');
    }
  }
?>