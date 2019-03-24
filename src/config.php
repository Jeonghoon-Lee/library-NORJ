<?php
  require __DIR__ . '\..\vendor\autoload.php';

  // MeekroDB Setup
  DB::$user = 'ipd';
  DB::$password = 'ipdipd';
  DB::$dbName = 'libraryNORJ';

  // init twig loader
  $loader = new \Twig\Loader\FilesystemLoader('..\templates');
  $twig = new \Twig\Environment($loader);
?>