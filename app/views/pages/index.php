<?php require APPROOT . '/views/includes/header.php'; ?>
<?php flash('success_msg'); ?>
<?php if (!empty($_SESSION['email_err']) && !empty($_SESSION['password_err'])): ?>
  <div class="alert alert-danger" id="msg-flash">Please fill all the fields</div>
<?php elseif (!empty($_SESSION['password_err'])): ?>
  <div class="alert alert-danger" id="msg-flash"><?php echo $_SESSION['password_err'] ?></div>
<?php elseif (!empty($_SESSION['email_err'])): ?>
  <div class="alert alert-danger" id="msg-flash"><?php echo $_SESSION['email_err'] ?></div>
<?php endif; ?>
<div class="grid-container">
  <div class="container">
    <h1 class="display-3">SocialBells</h1>
    <p class="lead">A simple social media website created by José Bellorín</p>
  </div>
  <div class="card card-body bg-light">
    <h2>Create an account</h2>
    <p>Please fill out this form to register with us</p>
    <form action="<?php echo URLROOT; ?>/users/register" method="POST">
      <div class="form-names">
        <div class="form-group">
          <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name'] ?>" placeholder="Name">
          <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
        </div>
        <div class="form-group">
          <input type="text" name="last_name" class="form-control form-control-lg <?php echo (!empty($data['last_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['last_name'] ?>" placeholder="Last Name">
          <span class="invalid-feedback"><?php echo $data['last_name_err']; ?></span>
        </div>
      </div>
      <div class="form-group">
        <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email'] ?>" placeholder="Email">
        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
      </div>
      <div class="form-group">
        <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password'] ?>" placeholder="Password">
        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
      </div>
      <div class="form-group">
        <input type="password" name="confirm_pass" class="form-control form-control-lg <?php echo (!empty($data['confirm_pass_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_pass'] ?>" placeholder="Confirm Password">
        <span class="invalid-feedback"><?php echo $data['confirm_pass_err']; ?></span>
      </div>
      <div class="row">
        <div class="col">
          <input type="hidden" name="register_form">
          <input type="submit" value="Register" class="btn btn-success btn-block">
        </div>
      </div>
    </form>
  </div>
</div>
<?php require APPROOT . '/views/includes/unset_msg.php'; ?>
<?php require APPROOT . '/views/includes/footer.php'; ?>