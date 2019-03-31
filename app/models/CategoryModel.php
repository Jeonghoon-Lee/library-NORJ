<?php
  class CategoryModel extends DB\SQL\Mapper {
    function __construct(DB\SQL $db) {
      parent::__construct($db, 'categories');
    }

    // fetch all the result from our table
    function fetch_all() {
      $this->load();

      $categories = array();
      foreach ($this->query as $value) {
        $categories[] = $value->cast();
      }
      return $categories;
    }

    // check id validation
    function is_valid_id($id) {
      return $this->count(array('CategoryID=?', $id));
    }
  }
?>