<?php
// homepage.php
  class HomePage {
    function index($f3) {
      echo $f3->get('twig')->render('home.html', array('BASE' => $f3->get('BASE')));
    }
  }
?>