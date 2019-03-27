<?php
  class BookModel extends DB\SQL\Mapper {
    function __construct(DB\SQL $db) {
      parent::__construct($db, 'books');
    }

    // fetch all the result from our table
    function fetch_all() {
      $this->load();

      // return $this->query->cast();
      $this->query;
    }

    function find_book($search_option) {
      $this->load($search_option);

      // if (sizeof($this->query) == 1) 
      //   return $this->query[0]->cast();

      return $this->query;  // empty array
    }

    function add_book() {
      $this->copyfrom('POST');
      $this->save();
    }

    function update_book($search_option) {
      $this->load($search_option);
      $this->copyfrom('POST');
      $this->update();
    }

    function delete_book($search_option) {
      $this->load($search_option);
      $this->erase();
    }
  }
?>