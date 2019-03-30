<?php
  class MemberModel extends DB\SQL\Mapper {
    function __construct(DB\SQL $db) {
      parent::__construct($db, 'users');
    }

    // fetch all the member list
    function fetch_all() {
      $this->load();
      return $this->query;
    }

    // find user by name
    function get_member_by_username($username) {
      $search_option = array('UserName = ?', $username);
      $this->load($search_option);
      return $this->query;
    }

    // check if username is exist.
    function is_exist_username($username) {
      $search_option = array('UserName = ?', $username);
      return $this->count($search_option);
    } 

    // create user
    function create_user() {
      $this->copyfrom('POST');
      $this->save();
    }

    function update_logintime_by_username($username) {
      $search_option = array('UserName = ?', $username);
      $this->load($search_option);
      $this->LastLoginTime = date('Y-m-d H:i:s');
      $this->save();
    }
  }
?>