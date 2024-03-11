<?php
$user_email;
if (isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['user_email'];
    if (!empty($_GET) && isset($_GET['new_user'])) {
        showMessage('Sie wurden erfolgreich registriert.', 'success');
    }
}
if (!empty($_GET) && isset($_GET['login_failed'])) {
    showMessage('Nutzername oder Passwort stimmen nicht überein!', 'danger');
}


?>
<form class="container" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="hidden" name="form_type" value="login">
    <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" name="email" id="email" placeholder="email@example.com" value="<?= $user_email ?? '' ?>">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password" id="inputPassword">
        </div>
    </div>
    <div class="mb-3 d-flex justify-content-end gap-3">
        <input class="btn btn-secondary" type="reset" value="Reset">
        <input class="btn btn-primary" type="submit" value="Submit">
    </div>
    <div class="mb-3 row">
        <a href="index.php?create_account=true" class="btn btn-outline-primary" role="button">Create new account <i class="bi bi-person-plus"></i></a>
    </div>
</form>