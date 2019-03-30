<?php
  class LoanViewModel extends DB\SQL\Mapper {
    function __construct(DB\SQL $db) {
      parent::__construct($db, 'loan_user_view');
    }

    // fetch all the member list
    function fetch_all() {
      $this->load();
      return $this->query;
    }

    // find loanlist by userid
    function get_loanlist_by_userid($id) {
      $search_option = array('UserID = ?', $id);
      $this->load($search_option);
      return $this->query;
    }

    function get_loan_count_by_userid($id) {
      $search_option = array('UserID = ?', $id);
      return $this->count($search_option);
    }
  }
?>