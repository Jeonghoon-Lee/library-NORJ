<?php
// ContactMessageModel.php
  class ContactMessageModel extends DB\SQL\Mapper {
    function __construct(DB\SQL $db) {
      parent::__construct($db, 'contactmessages');
    }

    // fetch all the result from our table
    function fetch_all() {
      // $this->load(array("order" => "MsgID DESC"));
      $this->load();
      return $this->query;
    }

    // add message
    function add_message() {
      $this->copyfrom('POST');
      $this->save();
    }

    function completed_message_by_id($id) {
      $search_option = array('MsgID = ?', $id);
      $this->load($search_option);
      $this->Status = 1;
      $this->update();
    }

    // delete message
    function delete_message_by_id($id) {
      $search_option = array('MsgID = ?', $id);
      $this->load($search_option);
      $this->erase();
    }
  }
?>