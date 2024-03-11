
<?php
if (!empty($_GET) && isset($_GET['delete'])) {
  $sql = 'DELETE FROM `tbl_posts`
    WHERE `posts_id` = :pi';

  try {
    if ($stmt = $pdo->prepare($sql)) {
      $stmt->bindParam(':pi', $_GET['delete']);

      if ($stmt->execute()) {
        echo '<p>Der Post wurden gelöscht.</p>';
      }
    }
    $stmt = NULL;
    $pdo = NULL;
  } catch (PDOException $e) {
    showMessage($e->getMessage(), 'danger');
  }
}
