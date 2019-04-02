<?php
// books.php
  class Books extends Controller {
    // define Model variable
    private $books;
    private $languages;
    private $categories;
    private $reservations;

    function __construct() {
      parent::__construct();
      // initialize Models
      $this->books = new BookModel($this->db);
      $this->languages = new LangModel($this->db);
      $this->categories = new CategoryModel($this->db);
      $this->reservations = new ReservationModel($this->db);
    }

    function home ($f3) {
      $newbooks = $this->books->get_new_books(3);

      $render_option = array(
        'session' => $f3->get('SESSION'),
        'newbooks' => $newbooks
      );
      echo $f3->get('twig')->render('home.html', $render_option);
    }

    function check_validation($f3) {
      $book_status = array('available', 'reserved', 'loaned');
      $error = '';
      if ($f3->get('POST.Title') == '') {
        $error = 'Please fill in Title.';
      } else if ($f3->get('POST.Publisher') == '') {
        $error = 'Please fill in Publisher.';
      } else if ($f3->get('POST.Author') == '') {
        $error = 'Please fill in Author.';
      } else if ($f3->get('POST.Year') == '') {
        $error = 'Please fill in Year.';
      } else if (!is_numeric($f3->get('POST.Year'))) {
        $error = 'Year should be numeric.';
      } else if ($f3->get('POST.LangID') == '') {
        $error = 'Please fill in LangID.';
      } else if ($this->languages->is_valid_id($f3->get('POST.LangID')) == 0) {
        $error = 'Language is invalid value.';
      } else if ($f3->get('POST.CategoryID') == '') {
        $error = 'Please fill in CategoryID.';
      } else if ($this->categories->is_valid_id($f3->get('POST.CategoryID')) == 0) {
        $error = 'Invalid Category value';
      } else if (($f3->get('POST.AgeRating') != 0) && ($f3->get('POST.AgeRating') != 1))  {
        $error = 'Invalid AgeRating value';
      } else if ($f3->get('POST.BookStatus') == '') {
        $error = 'Please fill in BookStatus.';
      } else if (!in_array($f3->get('POST.BookStatus'), $book_status)) {
        $error = 'BookStatus is invalid.';
      }
      return $error;
    }

    // create form to register a new book
    function create_form($f3) {
      $render_option = array(
        'session' => $f3->get('SESSION'),
        'url' => 'book/create',
        'subtitle' => 'Create Book',
        'languages' => $this->languages->fetch_all(),
        'categories' => $this->categories->fetch_all()
      );      
      echo $f3->get('twig')->render('form_book_create.html', $render_option);
    }

    // insert a new book information to the books table in DB
    function add_new_book($f3) {
      // echo '<pre>';
      // echo print_r($f3->get('POST'));
      // echo '</pre>';
      $error = $this->check_validation($f3);
      if ($error == '') {
        $this->books->add_book();
        // set value to display result
        $f3->set('SESSION.booklist', 'on');
        $f3->reroute('/search/result');
      } else {
        $render_option = array(
          'session' => $f3->get('SESSION'),
          'error' => $error,
          'url' => 'book/create',
          'subtitle' => 'Create Book',
          'languages' => $this->languages->fetch_all(),
          'categories' => $this->categories->fetch_all()  
        );      
        echo $f3->get('twig')->render('form_book_create.html', $render_option);
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
        // error
        $f3->reroute('/');    // back to home 
      }
    }

    // update the book information by ISBN
    function update_book($f3) {
      $error = $this->check_validation($f3);
      if ($error == '') {
        $this->books->update_book_by_isbn($f3->get('PARAMS.ISBN'));
        // set value to display result
        $f3->set('SESSION.booklist', 'on');
        $f3->reroute('/search/result');
      } else {
        $render_option = array(
          'session' => $f3->get('SESSION'),
          'error' => $error,
          'url' => 'book/create',
          'subtitle' => 'Create Book',
          'languages' => $this->languages->fetch_all(),
          'categories' => $this->categories->fetch_all()  
        );      
        echo $f3->get('twig')->render('form_book_create.html', $render_option);
      }
    }

    // delete book from books table
    function delete_book($f3) {
      if ($f3->get("SESSION.UserType") == "admin") {
        $this->books->delete_book_by_isbn($f3->get('PARAMS.ISBN'));
        // set value to display result
        $f3->set('SESSION.booklist', 'on');
        $f3->reroute('/search/result');
      }
    }

    function reserve_book($f3) {
      if ($f3->get("SESSION.UserID") != null) {
        $this->reservations->add_reserve_book($f3->get("SESSION.UserID"));

        $response = array(
          'status' => 200,    // 200: OK 
          'message' => 'Success'
        );
        http_response_code(200);
  
        // reply to client
        echo json_encode($response);  
      }
    }

    // display book list
    function book_list($f3) {
      $book_list = $this->books->fetch_all();
      echo sizeof($book_list);

      echo $f3->get('twig')->render('book_list.html');
    }
  }
?>