<?php
  include('.\config.php');
  include('.\functions.php');

  //
  // need to check user type
  // admin permission need
  //

  // check value is empty or length of value is less than maximum length.
  function is_empty($value_name, $data) {
    if ($data == '') {
      $error[] = $value_name . ' not allow empty value';
    }
  }

  function check_max_length($value_name, $data, $max_length) {
    if (strlen($data) > $max_length) {
      $error[] = $value_name . ' length should be less than ' . $max_length;
    }    
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    pr($_POST);

    // process registering book into database
    $title = (isset($_POST['title']) ? $_POST['title'] : '');
    $publisher = (isset($_POST['publisher']) ? $_POST['publisher'] : '');
    $author = (isset($_POST['author']) ? $_POST['author'] : '');
    $year = (isset($_POST['year']) ? $_POST['year'] : '');
    $language = (isset($_POST['language']) ? $_POST['language'] : '');
    $category = (isset($_POST['category']) ? $_POST['category'] : '');
    $rating = (isset($_POST['rating']) ? $_POST['rating'] : '');
    $status = (isset($_POST['status']) ? $_POST['status'] : '');
    $descrip = (isset($_POST['descrip']) ? $_POST['descrip'] : '');
    $image = (isset($_POST['new_filename']) ? $_POST['new_filename'] : '');
    $isbn = (isset($_POST['isbn']) ? $_POST['isbn'] : ''); 

    is_empty('Title', $title);
    check_max_length('Title', $title, 80);

    is_empty('Publisher', $publisher);
    check_max_length('Publisher', $title, 30);

    is_empty('Author', $author);
    check_max_length('Author', $author, 30);

    if ($descrip != '') check_max_length('Description', $descrip, 1024);
    if ($image != '') check_max_length('Book image', $image, 100);
    
    if (count($error) == 0) {
      // No error
      // Register a new book or update a book
      if ($isbn == '') $isbn = 0;  // default: 0 (auto incrementing column)
      $new_book = array(
        'ISBN' => $isbn,
        'Title' => $title,
        'Publisher' => $publisher,
        'Author' => $author,
        'Year' => $year,
        'LangID' => $language,
        'CategoryID' => $category,
        'AgeRating' => $rating,
        'BookStatus' => $status,
        'Description' => $descrip,
        'BookImage' => $image
      );
      DB::insertUpdate('books', $new_book);
    }
  } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $update_book_id = (isset($_GET['update']) ? $_GET['update'] : '');
    $delete_book_id = (isset($_GET['delete']) ? $_GET['delete'] : '');

    if (($update_book_id == '') && ($delete_book_id == '')) {
      // Load [register book] page
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
      // only allow one parameter - update or delete
      $error = 'Irregal access';
    } else if ($update_book_id != '') {
      // Load [update book] page
      // display selected book information
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
    } else if ($delete_book_id != '') {
      // delete book
      // check book id
      DB::delete('books', "ISBN=%d", $delete_book_id);
      //
      // back to list
      //
    }

    if ($error) {
      echo $error;
    }
  }
?>
