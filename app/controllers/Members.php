<?php
// members.php
  class Members {
    function create($f3) {

    }

    function list($f3) {
      echo $f3->get('twig')->render('member_list.html', array('BASE', $f3->get('BASE')));
    }
  }
?>