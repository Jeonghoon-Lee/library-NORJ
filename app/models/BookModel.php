<?php
  class BookModel extends DB\SQL\Mapper {
    function __construct(DB\SQL $db) {
      parent::__construct($db, 'books');
    }

    // fetch all the result from our table
    function fetch_all() {
      $this->load();
      return $this->query;
    }

    // find_book
    function find_book($search_option) {
      $this->load($search_option);
      return $this->query;  // empty array
    }

    // get book by isbn -> it will return only 1 book
    function find_by_isbn($isbn) {
      $search_option = array('ISBN = ?', $isbn);
      $this->load($search_option);
      return $this->query[0];
    }
    
    function add_book() {
      $this->copyfrom('POST');
      $this->save();
    }

    function update_book_by_isbn($isbn) {
      $search_option = array('ISBN = ?', $isbn);
      $this->load($search_option);
      $this->copyfrom('POST');
      $this->update();
    }

    function delete_book_by_isbn($ISBN) {
      $search_option = array('ISBN = ?', $ISBN);
      $this->load($search_option);
      $this->erase();
    }

    function get_new_books($no_of_books) {
      // doesn't work properly
      // $search_option = array('order' => 'Year DESC', 'limit' => 3);
      $search_option = array('order' => 'Year DESC');
      $this->load($search_option);
      return array_slice($this->query, 0, $no_of_books);
    }
  }
?>