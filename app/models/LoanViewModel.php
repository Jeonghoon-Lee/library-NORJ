<?php
  class LoanViewModel extends DB\SQL\Mapper {
    function __construct(DB\SQL $db) {
      parent::__construct($db, 'loan_user_view');
    }

    // fetch all the user list
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
      $search_option = array('DateIn is null and UserID = ?', $id);
      return $this->count($search_option);
    }

    function get_user_loans_by_id($id) {
      $search_option = array('DateIn is null and UserID = ?', $id);
      $this->load($search_option);

      // make associative array and return
      $loans = array();
      $filter_keys = array('Title', 'DateOut', 'DateDue');
      foreach ($this->query as $loan) {
        $loans[] = array_filter(
          $loan->cast(),
          function ($key) use ($filter_keys) {
              return in_array($key, $filter_keys);
          },
          ARRAY_FILTER_USE_KEY
        );
      }

      return $loans;
    }
  }
?>