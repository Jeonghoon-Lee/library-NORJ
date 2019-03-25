<?php
  include('.\config.php');
  include('.\functions.php');


  if ($_SERVER['REQUEST_METHOD'] == 'POST') {


  } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // need to check user type

    $update_book_id = (isset($_GET['update']) ? $_GET['update'] : '');
    $delete_book_id = (isset($_GET['delete']) ? $_GET['delete'] : '');

    if (($update_book_id == '') && ($delete_book_id == '')) {
      // register a new book
      $languages = DB::query('SELECT * FROM Languages');
      $categories = DB::query('SELECT * FROM Categories');

      echo $twig->render('manage_book.html.twig', 
        array(
          'subtitle' => 'Register Book',
          'languages' => $languages, 
          'categories' => $categories
        )
      );
    } else if (($update_book_id != '') && ($delete_book_id != '')) {
      // irregal access
      $error = 'Irregal access';
    } else if ($update_book_id != '') {
      $languages = DB::query('SELECT * FROM Languages');
      $categories = DB::query('SELECT * FROM Categories');

      $book = DB::queryFirstRow('SELECT * FROM Books WHERE isbn=%d', $update_book_id);
      pr($book);
      if ($book != null) {
        echo $twig->render('manage_book.html.twig', 
          array(
            'subtitle' => 'Update Book',
            'languages' => $languages, 
            'categories' => $categories, 
            'book' => $book
          )
        );
      } else {
        $error = 'No book found';
      }
      // display selected book information
      // retrieve database and check return length
    } else if ($delete_book_id != '') {
      // check book id
    }

    if ($error) {
      echo $error;
    }
  }
?>
