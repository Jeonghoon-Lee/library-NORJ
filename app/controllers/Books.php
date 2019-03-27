<?php
// books.php
  class Books extends Controller {

    function validateBookInfo() {
      //
      // need to implement validation
      //
      return true;
    }

    function createBookForm($f3) {
      $languages = new LangModel($this->db);
      $categories = new CategoryModel($this->db);

      $render_option = array(
        'url' => $f3->get('BASE').'/book/create',
        'subtitle' => 'Update a Book',
        'languages' => $languages->fetch_all(),
        'categories' => $categories->fetch_all()
      );      
      echo $f3->get('twig')->render('form_book_create.html', $render_option);
    }

    function createBookInfo($f3) {
      echo print_r($_POST);

      $books = new BookModel($this->db);
      if (validateBookInfo()) {
        $books->copyfrom('POST');
        $books->save();
      } else {
        echo 'error message';
      }
    }

    function updateBookForm($f3) {
      // testing
      // echo $f3->get('PARAMS.ISBN');
      $books = new BookModel($this->db);
      $languages = new LangModel($this->db);
      $categories = new CategoryModel($this->db);

      $search_option = array('ISBN = ?', $f3->get('PARAMS.ISBN'));
      $book = $books->find_book($search_option);

      if (count($book) == 1) {
        $render_option = array(
          'url' => $f3->get('BASE').'/book/update/'.$f3->get('PARAMS.ISBN'),
          'subtitle' => 'Update a Book',
          'book' => $book, 
          'languages' => $languages->fetch_all(),
          'categories' => $categories->fetch_all()
        );
        echo $f3->get('twig')->render('form_book_create.html', $render_option);
      } else {
        echo 'No book found';
      }
    }

    function updateBookInfo($f3) {
      echo print_r($_POST);

      $books = new BookModel($this->db);
      if (validateBookInfo()) {
        $books->copyfrom('POST');
        $books->save();
      } else {
        echo 'error message';
      }
    }
    
    function getBookList($f3) {
      $books = new BookModel($this->db);

      $book_list = $books->fetch_all();
      echo sizeof($book_list);

      echo $f3->get('twig')->render('book_list.html');
    }
  }
?>