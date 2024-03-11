<?php
if (!empty($_GET) && isset($_GET['new_article'])) {
  $posts_id = intval($_GET['new_article']);
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
            $user_name = $row->users_forename . $row->users_lastname;
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

<form class="container" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <input type="hidden" name="form_type" value="article">
  <input type="hidden" name="posts_id" value="<?= $posts_id ?? ''; ?>">
  <input type="hidden" name="posts_users_id_ref" value="<?= $users_id ?? ''; ?>">
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" placeholder="Add article title" name="posts_header" value="<?= $posts_header ?? ''; ?>">
  </div>
  <div class="mb-3">
    <label for="category" class="form-label">Category</label>
    <select class="form-select" id="category" aria-label="category" name="posts_categ_id_ref" value="<?= $posts_categ_id_ref ?? ''; ?>">
      <?php
      $sql = 'SELECT `categ_id`, `categ_name` FROM `tbl_categories`';

      try {
        if ($stmt = $pdo->prepare($sql)) {
          $stmt->execute();
          while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            echo '<option value="' . $row->categ_id . '" ' . ($categ_id == $row->categ_id ? 'selected' : '') . '>' . $row->categ_name . '</option>';
          }
        }
      } catch (PDOException $e) {
        showMessage($e->getMessage(), 'danger');
      }


      ?>
    </select>
  </div>

  <div class="mb-3">
    <label for="image" class="form-label">Title</label>
    <input type="text" class="form-control" id="image" placeholder="Add images link" name="posts_image" value="<?= $posts_image ?? ''; ?>">
  </div>
  <div class="mb-3">
    <label for="content" class="form-label">Article text</label>
    <textarea class="form-control" id="content" rows="15" name="posts_content"><?= $posts_content ?? ''; ?></textarea>
  </div>
  <div class="mb-3 d-flex justify-content-end gap-3">
    <input class="btn btn-primary" type="submit" value="Submit">
  </div>
</form>