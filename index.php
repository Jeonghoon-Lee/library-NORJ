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
  $twig = new \Twig\Environment($loader);

  $f3->set('twig', $twig);
  
  // routes
  // $f3->route('GET /', function() {
  //   echo 'Hello, world!';
  // });
  
  // $f3->route('GET /', 'Pages->homepage');
  // $f3->route('GET /about', 'Pages->about');
  // $f3->route('GET /temp', 'Pages->temp');

  // $f3->route('GET @member_list: /members', 'Users->listing');
  // $f3->route('GET @member_create: /members/create', 'Users->create');
  $f3->route('GET /', 'HomePage->index');

  // execute f3
  $f3->run();
?>