<?php
  function pr($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
  }

  $error = '';
  $categories = '';
  $languages = '';

  function get_category_list() {
    $categories = DB::query('SELECT * FROM Categories');
  }

  function get_language_list() {
    $languages = DB::query('SELECT * FROM Languages');
  }  
?>
