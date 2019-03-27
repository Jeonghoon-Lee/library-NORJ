<?php
// books.php
  class Books extends Controller {
    function createBook($f3) {
      $render_option = array(
        'subtitle' => 'Update a Book'
      );      
      echo $f3->get('twig')->render('manage_book.html', $render_option);
    }

    function getBook($f3) {
      // testing
      // echo $f3->get('PARAMS.ISBN');
      $books = new BookModel($this->db);
      $languages = new LangModel($this->db);
      $categories = new CategoryModel($this->db);

      $search_option = array('ISBN = ?', $f3->get('PARAMS.ISBN'));
      $book = $books->find_book($search_option);

      $render_option = array(
        'subtitle' => 'Update a Book',
        'book' => $book, 
        'languages' => $languages->fetch_all(),
        'categories' => $categories->fetch_all()
      );
      echo $f3->get('twig')->render('manage_book.html', $render_option);
    }
    
    function getBookList($f3) {
      $books = new BookModel($this->db);

      $book_list = $books->fetch_all();
      echo sizeof($book_list);

      echo $f3->get('twig')->render('book_list.html');
    }
  }
?>