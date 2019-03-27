<?php
  class BookModel extends DB\SQL\Mapper {
    function __construct(DB\SQL $db) {
      parent::__construct($db, 'books');
    }

    // fetch all the result from our table
    function fetch_all() {
      $this->load();

      return $this->query->cast();
    }

    function find_book($criteria) {
      $this->load($criteria);

      if (sizeof($this->query) == 1) 
        return $this->query[0]->cast();

      return $this->query;  // empty array
    }
  }
?>