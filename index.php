<?php
// index.php
  require_once('vendor/autoload.php');

  // initiate f3
  $f3 = Base::instance();

  // configuration
  // $f3->set('AUTOLOAD', 'controllers/');
  // $f3->set('DEBUG', 3);

  // use a configuration file
  $f3->config('app/config/config.ini');

  $loader = new \Twig\Loader\FilesystemLoader('app\views');
  $loader->addPath('public', 'public');
  $twig = new \Twig\Environment($loader);

  $f3->set('twig', $twig);
  
  $f3->route('GET /', 'HomePage->index');

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


  // execute f3
  $f3->run();
?>