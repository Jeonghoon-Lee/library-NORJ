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

    function get_user_reservation_by_id($id) {
      $search_option = array('ReservStatus like "reserved" and UserID = ?', $id);
      $this->load($search_option);
      
      // make associative array and return
      $reservations = array();
      $filter_keys = array('ReservID', 'Title', 'ReservDate', 'ReservStatus');
      foreach ($this->query as $reserve) {
        $reservations[] = array_filter(
          $reserve->cast(),
          function ($key) use ($filter_keys) {
              return in_array($key, $filter_keys);
          },
          ARRAY_FILTER_USE_KEY
        );
      }

      // make associative array and return
      return $reservations;      
    }
  }
?>