<?php 
if (!empty($_GET) && isset($_GET['category'])) {
    $posts_id = intval($_GET['category']);
    if ($posts_id) {
      $sql = 'SELECT * FROM `tbl_posts` WHERE `posts_categ_id_ref` =' . $posts_id;
      
    }
  }