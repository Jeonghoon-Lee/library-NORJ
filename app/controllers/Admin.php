<?php
// Admin.php
  class Admin extends Controller {
    // define Model variable
    private $books;
    private $book_list;
    private $languages;
    private $categories;
    private $users;

    function __construct() {
      parent::__construct();
      // initialize Models
      $this->books = new BookModel($this->db);
      $this->book_list = new BookViewModel($this->db);
      $this->languages = new LangModel($this->db);
      $this->categories = new CategoryModel($this->db);
      $this->users = new UserModel($this->db);
    }

    function book_list($f3) {
      if ($f3->get('SESSION.UserType') == 'admin') {
        $render_option = array(
          'session' => $f3->get('SESSION'),
          'subtitle' => 'Book List',
          'books' => $this->book_list->fetch_all()
        );          
        echo $f3->get('twig')->render('search_result.html', $render_option);
      } else {
        $f3->reroute('/');
      }
    }

    function user_list($f3) {
      if ($f3->get('SESSION.UserType') == 'admin') {
        $render_option = array(
          'session' => $f3->get('SESSION'),
          'subtitle' => 'User List',
          'users' => $this->users->fetch_all()
        );
        echo $f3->get('twig')->render('user_list.html', $render_option);
      } else {
        $f3->reroute('/');
      }
    }
  }
?>