<?php
  class UserModel extends DB\SQL\Mapper {
    function __construct(DB\SQL $db) {
      parent::__construct($db, 'users');
    }

    // fetch all the user list
    function fetch_all() {
      $this->load();
      return $this->query;
    }

    // find user by name
    function get_user_by_userid($userid) {
      $search_option = array('UserID = ?', $userid);
      $this->load($search_option);
      return $this->query;
    }    

    // find user by name
    function get_user_by_username($username) {
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
      $this->update();
    }

    function update_user_by_id($id) {
      $search_option = array('UserID = ?', $id);
      $this->load($search_option);
      $this->copyfrom('POST');
      $this->update();
    }

    function delete_user_by_id($id) {
      $search_option = array('UserID = ?', $id);
      $this->load($search_option);
      $this->erase();
    }    
  }
?>