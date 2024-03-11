<?php
$selectedCategory = '';
function checkIsEmpty($st)
{
    if ($st->rowCount() === 0) {
        echo '<p>' . 'Keine Datensatze gefunden' . '</p>';
    }
}

function getArticlePreview($data)
{
    $string = $data->posts_content;
    echo '<div class="col-6">';
    echo '<div class="p-3 border bg-light">';
    echo '<div class="row g-0 bg-light position-relative overflow-hidden" style="height: 300px">';
    echo ' <div class="col-md-6 mb-md-0 p-md-4">';
    echo '<img src=' . $data->posts_image . ' class="img-fluid" alt="image">';
    echo '</div>';
    echo '<div class="col-md-6 p-4 ps-md-0">';
    echo '<h6 class="mt-0">' . '<a href="index.php?article=' . $data->posts_id . '" >' . $data->posts_header . '</a></h6>';
    echo '<p>' . mb_strimwidth($string, 0, 100, "...") . '</p>';
   
    echo '</div>';
    if (!empty($_SESSION) && isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {
        echo '<div class="d-flex justify-content-around">';
        echo '<a href="index.php?new_article=' . $data->posts_id . '" >Edit <i class="bi bi-pencil"></i></a>';
        echo '<a href="index.php?delete=' . $data->posts_id . '" style="color: #ff0000">Delete <i class="bi bi-trash3"></i></a>';
        echo '</div>';

    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

if (!empty($_GET) && isset($_GET['added_article'])) {
    $message = 'Der Post ' . $posts_header . ' wurde angelegt. <a href="' 
    . $_SERVER['SCRIPT_NAME'] . '?article=' .  $posts_id . '">Neuen Artikel anlegen.</a>';
    showMessage($message, 'success');
}

if (!empty($_GET) && isset($_GET['category'])) {
    $posts_id = intval($_GET['category']);
    if ($posts_id) {
      $sql_cat = 'SELECT * FROM `tbl_categories` WHERE `categ_id` =' . $posts_id;
      try {
        if ($stmt = $pdo->query($sql_cat)) {
            while ($cat = $stmt->fetch(PDO::FETCH_OBJ)) {
                if ($cat) {
                    $selectedCategory = $cat->categ_name;
                }
            }
        }
    } catch (PDOException $e) {
        showMessage($e->getMessage(), 'danger');
    }
    }
    $stmt = NULL;
  }

?>

<div class="container">
    <h1>Articles 
        <?php
        
        if($selectedCategory) {
            echo '<span class="badge bg-light text-dark">'. $selectedCategory .'</span>';
        }
        
    ?>
    </h1>
</div>
<hr class="border border-primary border-3 opacity-75">

<div class="container overflow-hidden text-center">
    <div class="row gy-5">
        <?php
        require_once 'includes/_pdo-connection.inc.php';
        
        // $sql = 'SELECT * FROM `tbl_posts`';
        $sql = 'SELECT `posts_id`,
              `posts_header`,
              `posts_content`,
              `posts_image`,
              `posts_created_at`,
              `posts_updated_at`,              
              `users_forename`,
              `users_lastname`,
              `categ_name`
           FROM `tbl_posts` b
           JOIN `tbl_users` a 
           ON b.posts_users_id_ref = a.users_id
           JOIN `tbl_categories` c 
           ON b.posts_categ_id_ref = c.categ_id ';

        if (!empty($_GET) && isset($_GET['category'])) {
            $posts_id = intval($_GET['category']);
            if ($posts_id) {
              $sql .= ' WHERE `posts_categ_id_ref` =' . $posts_id;
            }
            $stmt = NULL;
          }
        try {
            if ($stmt = $pdo->query($sql)) {
                checkIsEmpty($stmt);
                while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                    if ($row) {

                        getArticlePreview($row);
                    }
                }
            }
        } catch (PDOException $e) {
            showMessage($e->getMessage(), 'danger');
        }
        $stmt = NULL;
        $pdo = NULL;
        ?>
    </div>
</div>