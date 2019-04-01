<?php
  class ReserveViewModel extends DB\SQL\Mapper {
    function __construct(DB\SQL $db) {
      parent::__construct($db, 'reserve_user_view');
    }

    // fetch all the user list
    function fetch_all() {
      $this->load();
      return $this->query;
    }

    // find reservedlist by userid
    function get_reservedlist_by_userid($id) {
      $search_option = array('UserID = ?', $id);
      $this->load($search_option);
      return $this->query;
    }

    // find reservedlist by userid
    function get_reserved_count_by_userid($id) {
      $search_option = array('UserID = ?', $id);
      return $this->count($search_option);
    }

    function get_user_reservation($id) {
      $search_option = array('UserID = ?', $id);
      $this->select('ReservID, Title, ReservDate, ReservStatus' , $search_option);
      // make associative array and return
      return $this->query;      
    }
  }
?>