<?php
// members.php
  class Members extends Controller {
    private $members;

    function __construct(){
      parent::__construct();
      // Initialize Models
      $this->members = new MemberModel($this->db);
    }

    function create_form($f3) {
      echo '<h2>Load Register User Form</h2>';
    }

    function create($f3) {
      echo '<h2>DB update and Create Account Done</h2>';
    }

    function update_form($f3) {
      echo '<h2>Load Update User Form</h2>';      
    }

    function update($f3) {
      echo '<h2>Load Update User Form</h2>';      
    }

    function delete_account($f3) {
      echo '<h2>account was deleted successfully.</h2>';
    }

    // admin user function
    function list($f3) {
      echo '<h2>User list for Admin</h2>';      
    }
  }
?>