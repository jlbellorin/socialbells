<?php
  class Pages extends Controller {
    public function __construct() {
      $this->userModel = $this->model('User');
      if (!isset($_SESSION['email']) && !isset($_SESSION['password']) && !isset($_SESSION['email_err']) && !isset($_SESSION['password_err'])) {        
        $_SESSION['email'] = '';
        $_SESSION['password'] = '';
        $_SESSION['password_err'] = '';
        $_SESSION['email_err'] = '';
      }
    }

    public function index() {
      if (isLoggedIn()) {
        redirect('posts');
      }
      $data = [
        'name' => '',
        'last_name' => '',
        'email' => '',
        'password' => '',
        'confirm_pass' => '',
        'name_err' => '',
        'last_name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_pass_err' => ''
      ];
      $this->view('pages/index', $data);
    }

    public function __destruct() {
      unset($_SESSION['email']);
      unset($_SESSION['password']);
      unset($_SESSION['password_err']);
      unset($_SESSION['email_err']);
    }
  }