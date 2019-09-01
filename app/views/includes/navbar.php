<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav ml-auto">
        <?php if (isset($_SESSION['user_id'])): ?>
          <!-- LOGGED IN OPTIONS -->
          <li class="nav-item">
            <a class="nav-link disabled mr-3" href="#">Welcome, <?php echo $_SESSION['user_name']; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
          </li>
          <!-- END LOGGED IN OPTIONS -->
        <?php else: ?>
          <!-- LOGIN FORM --> 
          <form class="login-form pull-right" action="<?php echo URLROOT; ?>/users/login" method="POST">
            <span>
              <input type="email" name="email" class="form-control form-control-sm <?php echo (!empty($_SESSION['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $_SESSION['email'] ?>" placeholder="Email">
              <!--<span class="invalid-feedback"><?php //echo $_SESSION['email_err']; ?></span>-->
            </span>
            <span>
              <input type="password" name="password" class="form-control form-control-sm <?php echo (!empty($_SESSION['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $_SESSION['password'] ?>" placeholder="Password">
              <!--<span class="invalid-feedback"><?php //echo $_SESSION['password_err']; ?></span>-->
            </span>
            <span>
              <input type="hidden" name="login_form">
              <input type="submit" value="Login" class="btn btn-sm btn-success btn-block">
            </span>
          </form>
          <!-- END LOGIN FORM -->
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>