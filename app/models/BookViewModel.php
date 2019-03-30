<?php
  class BookViewModel extends DB\SQL\Mapper {
    function __construct(DB\SQL $db) {
      parent::__construct($db, 'booklist_view');
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
  }
?>