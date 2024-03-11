
<?php
require_once '_pdo-connection.inc.php';
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
if (!empty($_POST) && isset($_POST['email']) && (isset($_POST['form_type']) && $_POST['form_type'] == 'login')) {
  $sql = 'SELECT * FROM `tbl_users`
        WHERE `users_email`= :ue';
  try {
    if ($stmt = $pdo->prepare($sql)) {
      $stmt->bindParam(':ue', $_POST['email']);
      $stmt->execute();
      if ($stmt->rowCount() === 0) {
        showMessage('Nutzername oder Passwort stimmen nicht überein!', 'danger');
      } else {
        $row = $stmt->fetch(PDO::FETCH_OBJ);

        if (password_verify($_POST['password'], $row->users_password)) {
          $_SESSION['user'] = $row->users_forename . ' ' . $row->users_lastname;
          $_SESSION['user_email'] = $row->users_email;
          $_SESSION['is_logged_in'] = true;
          $_POST = array();

          header("Location: http://$host$uri");
        } else {

          header("Location: http://$host$uri?login=true&login_failed=true");
        }
      }
    }
  } catch (PDOException $e) {
    echo 'ERROR: <br>' . $e->getMessage();
  }
  $stmt = NULL;
  $pdo = NULL;
}
