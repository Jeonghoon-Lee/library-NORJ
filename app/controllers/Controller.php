<?php
// Controller.php
  class Controller {
    protected $f3;
    protected $db;

    function __construct() {
      $f3 = Base::instance();
      $this->f3 = $f3;

      $db = new DB\SQL(
        $f3->get('DBNAME'),
        $f3->get('DBUSER'),
        $f3->get('DBPASS'),
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
      );
      $this->db = $db;
    }
  }
?>