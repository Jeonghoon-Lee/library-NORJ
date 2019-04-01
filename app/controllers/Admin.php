<?php
// Admin.php
  class Admin extends Controller {
    // define Model variable
    private $book_list;
    private $users;
    private $messages;

    function __construct() {
      parent::__construct();
      // initialize Models
      $this->book_list = new BookViewModel($this->db);
      $this->users = new UserModel($this->db);
      $this->messages = new ContactMessageModel($this->db);      
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
        $render_options = array(
          'session' => $f3->get('SESSION'),
          'subtitle' => 'User List',
          'users' => $this->users->fetch_all()
        );
        echo $f3->get('twig')->render('user_list.html', $render_options);
      } else {
        $f3->reroute('/');
      }
    }

    function message_list($f3) {
      if ($f3->get('SESSION.UserType') == 'admin') {
        $render_options = array(
          'session' => $f3->get('SESSION'),
          'subtitle' => 'Message List',
          'messages' => $this->messages->fetch_all()
        );
        echo $f3->get('twig')->render('message_list.html', $render_options);
      } else {
        $f3->reroute('/');
      }
    }    
  }
?>