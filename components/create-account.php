<div class="container">
    <h1>Registrierung</h1>

    <p><br></p>

    <!-- <form class="row g-3 needs-validation" novalidate> -->
    <form class="row g-3 needs-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

      <input type="hidden" name="form_type" value="register">

      <div class="col-md-4">
        <label for="u_vname" class="form-label">Benutzervorname</label>
        <input type="text" name="u_vname" class="form-control" id="validationCustom01" value="<?= $u_vname; ?>" required />
        <div class=" valid-feedback">Looks good!
        </div>
      </div>

      <div class="col-md-4">
        <label for="u_name" class="form-label">Benutzername</label>
        <input type="text" name="u_name" class="form-control" id="validationCustom02" value="<?= $u_name; ?>" required />
        <div class="valid-feedback">Looks good!</div>
      </div>


      <div class="col-md-6">
        <p>Anrede:<br></p>

        <div class="form-check form-check-inline">
          <!-- checked -->
          <input class="form-check-input" type="radio" name="u_anrede" id="inlineRadio1" value="Herr" checked>
          <label class="form-check-label" for="inlineRadio1">Herr</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="u_anrede" id="inlineRadio2" value="Frau" <?= $checked_f ?? ''; ?>>
          <label class="form-check-label" for="inlineRadio2">Frau</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="u_anrede" id="inlineRadio3" value="Divers" <?= $checked_d ?? ''; ?>>
          <label class="form-check-label" for="inlineRadio3">Divers</label>
        </div>
      </div>

      <div class="mb-3">
        <label for="email">E-Mail-Adresse</label>
        <input type="email" name="email" id="email" class="form-control" required>
        <!-- Optional : Hinweis zum Formular-Element -->
        <!-- small.form-text.text-muted -->
        <small class="form-text text-muted">Bitte hier eine Mail-Adresse eintragen</small>
      </div>


      <div class="col-md-3">
        <label for="validationCustom05" class="form-label">Passwort</label>
        <input type="password" name="password" class="form-control" id="validationCustom05" required />

        <div class="invalid-feedback">Bitte hier ein Passwort eintragen</div>
      </div>

      <div class="col-12">
        <button class="btn btn-primary" typ="submit" value="registrieren">Submit form</button>
      </div>
    </form>
  </div>