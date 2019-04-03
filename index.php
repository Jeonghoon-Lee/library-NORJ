<?php
// index.php
  require_once('vendor/autoload.php');

  // initiate f3
  $f3 = Base::instance();

  // set the default timezone
  date_default_timezone_set('America/Toronto');

  // use a configuration file
  $f3->config('app/config/config.ini');

  $loader = new \Twig\Loader\FilesystemLoader('app\views');
  $loader->addPath('public', 'public');
  $twig = new \Twig\Environment($loader);

  $f3->set('twig', $twig);


  // Home page
  $f3->route('GET /', 'Books->home');

  // About page
  $f3->route('GET /about', function($f3) {
    $render_option = array(
      'session' => $f3->get('SESSION')
    );  
    echo $f3->get('twig')->render('about.html', $render_option);
  });

  /**
   * Book handling
   */
  // create book
  $f3->route('GET /book/create', 'Books->create_form');
  $f3->route('POST /book/create', 'Books->add_new_book');
  // update book
  $f3->route('GET /book/update/@ISBN', 'Books->update_form');
  $f3->route('POST /book/update/@ISBN', 'Books->update_book');
  // delete book
  $f3->route('GET /book/delete/@ISBN', 'Books->delete_book');
  // reserve book
  $f3->route('POST /book/reserve', 'Books->reserve_book');

  /**
   * Users 
   */
  // register user
  $f3->route('GET /user/create', 'Users->create_form');
  $f3->route('POST /user/create', 'Users->create');
  // update Users
  $f3->route('GET /user/update/@id', 'Users->update_form');
  $f3->route('POST /user/update/@id', 'Users->update');
  // delete account
  $f3->route('GET /user/delete/@id', 'Users->delete_account');

  // login user
  $f3->route('GET /user/login', 'Users->login_form');
  $f3->route('POST /user/login', 'Users->login');
  // logout
  $f3->route('GET /user/logout', 'Users->logout');

  // login user account information
  $f3->route('GET /user/detail', 'Users->get_account_detail');
  
  // Contact page
  $f3->route('GET /contact', 'Users->contact_form');
  $f3->route('POST /contact', 'Users->contact');
  $f3->route('POST /contact/update', 'Users->update_message');


  /**
   * Search
   */
  // search book
  $f3->route('GET /search', 'Search->search_book');

  $f3->route('GET /search/result', 'Search->search_result');
  $f3->route('POST /search/result', 'Search->detail_search_result');
  // get book detail
  $f3->route('GET /search/detail/@ISBN', 'Search->get_detail');

  /**
   * Admin Users
   */
  $f3->route('GET /admin/home', 'Admin->book_list');
  $f3->route('GET /admin/user_list', 'Admin->user_list');
  $f3->route('GET /admin/book_list', 'Admin->book_list');
  $f3->route('GET /admin/message_list', 'Admin->message_list');

  // other function page
  $f3->route('GET|POST|PUT /book/upload_image', 'UploadImage->book_image');
  $f3->route('GET|POST /user/get_user_loans', 'Users->get_user_loans');
  $f3->route('GET|POST /user/get_user_reservations', 'Users->get_user_reservations');

  // execute f3
  $f3->run();

?>
