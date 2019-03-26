<?php
  class HomePage {
    function index($f3) {
      echo $f3->get('twig')->render('base.html');
    }
  }
?>