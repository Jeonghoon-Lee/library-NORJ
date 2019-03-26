<<<<<<< HEAD
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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1>Library HOME ^^</h1>
  <a href="src/manage_book.php">register a book</a><br/>
  <a href="templates/advance_search.html">Advanced Search</a><br/>
  <a href="templates/booksDetails.html">book details</a><br/>
  <a href="templates/main.html.twig">main</a><br/>
  <a href="src/search_result.php">search result</a><br>
  <a href="src/login.php">login</a><br>
  <a href="src/home.php">home</a><br>
  <a href="src/create_user.php">Create User</a><br>
  <a href="src/manage_account.php">User Account</a><br>
</body>
</html>

>>>>>>> create fat-free framework directory structure
