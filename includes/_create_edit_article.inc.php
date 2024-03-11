<?php 
    $is_user_login = isset($_SESSION['user']) && ($_SESSION['is_logged_in'] === true);
    if ($is_user_login && !empty($_POST) && (isset($_POST['form_type']) && $_POST['form_type'] == 'article')) {
        $posts_id = intval($_POST['posts_id']);
        $sql_create = 'INSERT INTO `tbl_posts`
            (
              `posts_header`,
              `posts_content`,
              `posts_image`,
              `posts_users_id_ref`,
              `posts_categ_id_ref`
            )
            VALUES
            (
              :ph, :pc, :pi, :pui, :pci
            )';

        $sql_update = 'UPDATE `tbl_posts` SET 
            `posts_header` = :ph,
            `posts_content` = :pc,
            `posts_image` = :pi,
            `posts_users_id_ref` = :pui,
            `posts_categ_id_ref` = :pci
             WHERE `posts_id` = ' . $posts_id;

        $sql = $posts_id ? $sql_update : $sql_create;

        
        $posts_header = $_POST['posts_header'];
        $posts_content = $_POST['posts_content'];
        $posts_image = $_POST['posts_image'];
        $posts_users_id_ref = intval($_POST['posts_users_id_ref']);
        $posts_categ_id_ref = intval($_POST['posts_categ_id_ref']);
  
        try {
          if( $stmt = $pdo->prepare($sql) ) {
            $stmt->bindParam(':ph', $posts_header);
            $stmt->bindParam(':pc', $posts_content);
            $stmt->bindParam(':pi', $posts_image);
            $stmt->bindParam(':pui', $posts_users_id_ref);
            $stmt->bindParam(':pci', $posts_categ_id_ref);
  
            if( $stmt->execute()) {
                $message = 'Der Post ' . $posts_header . ' wurde angelegt. <a href="' 
                . $_SERVER['SCRIPT_NAME'] . '?article=' .  $posts_id . '">Ein neuer Artikel wurde erstellt.</a>';
                showMessage($message, 'success');
            } else {
                showMessage('Artikel konnte nicht angelegt werden.', 'danger');
            }
          }
        } catch(PDOException $e) {
            showMessage($e->getMessage(), 'danger');
        }
        $stmt = NULL;
        $pdo = NULL;
    }