<?php
  class ReservationModel extends DB\SQL\Mapper {
    function __construct(DB\SQL $db) {
      parent::__construct($db, 'reservations');
    }

    // fetch all the result from our table
    function fetch_all() {
      $this->load();
      return $this->query;
    }

    function add_reserve_book($userID) {
      $this->copyfrom('POST');
      $this->UserID = $userID;
      $this->ReservDate = date('Y-m-d H:i:s');
      $this->ReservStatus = 'reserved';
      $this->save();
    }
  }
?>