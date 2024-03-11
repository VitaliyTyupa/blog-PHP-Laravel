    <?php
    if (!empty($_GET) && isset($_GET['article'])) {
      $posts_id = intval($_GET['article']);
      if ($posts_id) {
        $sql = 'SELECT `posts_id`,
                  `posts_header`,
                  `posts_content`,
                  `posts_image`,
                  `posts_created_at`,
                  `posts_updated_at`, 
                  `users_id`,             
                  `users_forename`,
                  `users_lastname`,
                  `categ_name`,
                  `categ_id`
                   FROM `tbl_posts` b
               JOIN `tbl_users` a 
               ON b.posts_users_id_ref = a.users_id
               JOIN `tbl_categories` c 
               ON b.posts_categ_id_ref = c.categ_id
               WHERE `posts_id` = ' . $posts_id;
        try {
          if ($stmt = $pdo->prepare($sql)) {
            $stmt->execute();
            if ($stmt->rowCount() === 0) {
              $message = 'Article with ID:' . $posts_id . 'is not exist';
              showMessage($message, 'danger');
            } else {
              while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                $posts_header = $row->posts_header;
                $posts_content = $row->posts_content;
                $posts_image = $row->posts_image;
                $posts_created_at = $row->posts_created_at;
                $posts_updated_at = $row->posts_updated_at;
                $users_id = $row->users_id;
                $user_name = $row->users_forename . ' ' . $row->users_lastname;
                $categ_id = $row->categ_id;
                $categ_name = $row->categ_name;
              }
            }
          }
        } catch (PDOException  $e) {
          showMessage($e->getMessage(), 'danger');
        }
      }
    }
    ?>
    <?php
    echo '<div class="container card">';
    echo '<div class="row">';
    echo '<div class="col-lg-12 p-2">';
    echo "<h1>$posts_header</h1>";
    echo '<div class="d-flex justify-content-start align-items-baseline">';
    echo "<div class='me-4'>Author:<h4 class='me-4'> $user_name</h4></div>";
    echo "<div class='me-4'>Category:<h4 class='me-4'> $categ_name</h4></div>";
    echo '</div>';
    echo '<div class="d-flex justify-content-between">';
    echo '<div>';
    echo "<p class='card-text'><small class='text-body-secondary'>Created " . sql2germanDate($posts_created_at) . "</small></p>";
    echo '</div>';
    echo '<div>';
    echo "<p class='card-text'><small class='text-body-secondary'>Last updated " . sql2germanDate($posts_updated_at) . "</small></p>";
    echo '</div>';
    echo '</div>';
    if ($posts_image) {
      echo '<img src="';
      echo $posts_image;
      echo '" class="float-end mt-2 ms-3" alt="image" style="width: 50%">';
    }
    echo '<p class="card-text">';
    echo $posts_content;
    echo '</p>';
    if (!empty($_SESSION) && isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {
      echo '<div class="d-flex justify-content-around">';
      echo '<a href="index.php?new_article=' . $posts_id . '" >Edit <i class="bi bi-pencil"></i></a>';
      echo '<a href="index.php?delete=' . $posts_id . '" style="color: #ff0000">Delete <i class="bi bi-trash3"></i></a>';
      echo '</div>';
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
    ?>