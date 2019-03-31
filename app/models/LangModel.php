<?php
  class LangModel extends DB\SQL\Mapper {
    function __construct(DB\SQL $db) {
      parent::__construct($db, 'languages');
    }

    // fetch all the result from our table
    function fetch_all() {
      $this->load();

      $languages = array();
      foreach ($this->query as $value) {
        $languages[] = $value->cast();
      }
      return $languages;
    }

    // check id validation
    function is_valid_id($id) {
      return $this->count(array('LangID=?', $id));
    }
  }
?>