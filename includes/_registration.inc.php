<?php
$u_vname = '';
$u_name = '';
if (!empty($_POST) && (isset($_POST['form_type']) && $_POST['form_type'] == 'register')) {

    $err_msg = '';
    $error = false;
    $email = "";
    $message = '';
    $mese = '';




    $u_vname = $_POST['u_vname'];
    $u_name = $_POST['u_name'];
    $u_anrede = $_POST['u_anrede'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $checked_m = $u_anrede === 'Herr' ? 'checked' : '';
    $checked_f = $u_anrede === 'Frau' ? 'checked' : '';
    $checked_d = $u_anrede === 'Divers' ? 'checked' : '';


    // ----------------
    // Подключение к базе данных
    // $pdo = new PDO('mysql:dbname=название_базы_данных;host=localhost;charset=utf8', 'имя_пользователя', 'пароль');

    // Подготовка SQL-запроса
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM tbl_users WHERE users_email = :users_email');

    // Установка значения параметра :email
    $users_email = $email;
    $stmt->bindParam(':users_email', $users_email);

    // Выполнение запроса
    $stmt->execute();

    // Получение результата
    $count = $stmt->fetchColumn();

    // Проверка наличия значения
    if ($count > 0) {;

        $message .= 'Der Wert email= ';
        $message .= $users_email;
        $message .= ' ist nicht eindeutig.<br>';
    } else {
    }
    // SQL-Anweisung und Datenbank-Abfrage durchführen`
    $sql = 'INSERT INTO `tbl_users`
            (
              `users_forename`, `users_lastname`, `users_sal`, `users_email`, `users_password`
              
            )
            VALUES
            (
              :uf, :un, :us, :ue, :up
            )';

    try {
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(':uf', $u_vname);
            $stmt->bindParam(':un', $u_name);
            $stmt->bindParam(':us', $u_anrede);
            $stmt->bindParam(':ue', $email);

            // ! Passwort-Verschlüsselung durch die PHP-Funktion password_hash()

            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bindParam(':up', $password_hash);

            if ($stmt->execute()) {
                $_SESSION['user_email'] = $email;
                $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                header("Location: http://$host$uri?login=true&new_user=true");
            }
        }
        $stmt = NULL;
        $pdo = NULL;
    } catch (PDOException $e) {

        $mese .= 'ERROR: ';
        $mese .= $e->getMessage();

        showMessage($mese, 'danger');
    }
}
