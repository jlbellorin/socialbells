<?php
  class Users extends Controller {
    public function __construct() {
      $this->userModel = $this->model('User');
    }

    public function register() {
      // Check the methods
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Process the form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // Init data
        $data = [
          'name' => trim($_POST['name']),
          'last_name' => trim($_POST['last_name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_pass' => trim($_POST['confirm_pass']),
          'name_err' => '',
          'last_name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_pass_err' => ''
        ];

        // Validate Name
        if (empty($data['name'])) {
          $data['name_err'] = 'Please enter your name';
        }
        // Validate Last Name
        if (empty($data['last_name'])) {
          $data['last_name_err'] = 'Please enter your last name';
        }
        // Validate Email
        if (empty($data['email'])) {
          $data['email_err'] = 'Please enter your email';
        } else {
          // Check email
          if ($this->userModel->findUserByEmail($data['email'])) {
            $data['email_err'] = 'Email is already taken';
          }
        }
        // Validate Password
        if (empty($data['password'])) {
          $data['password_err'] = 'Please enter your password';
        } elseif (strlen($data['password']) < 6) {
          $data['password_err'] = 'The password must be at least 6 characters';
        }
        // Validate Password Confirmation
        if (empty($data['confirm_pass'])) {
          $data['confirm_pass_err'] = 'Please confirm the password';
        } else {
          if ($data['password'] != $data['confirm_pass']) {
            $data['confirm_pass_err'] = 'Passwords do not match';
          }
        }
        // Make sure errors are empty
        if (empty($data['name_err']) && empty($data['last_name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_pass_err'])) {
          // Validated
          // Hashing the password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
          // Register user
          if ($this->userModel->register($data)) {
            flash('success_msg', 'You are registered and can log in');
            redirect('');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('pages/index', $data);
        }
      } else {
        if (isLoggedIn()) {
          redirect('pages/index');
        }
        // Init data
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
        // Load the view
        $this->view('pages/index', $data);
      }
    }

    public function login() {
      redirect('');
      // Check the methods
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Process the form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // Init data
        $data = [
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'email_err' => '',
          'password_err' => ''
        ];
        // Validate Email
        if (empty($data['email'])) {
          $data['email_err'] = 'Please enter your email';
        }
        // Validate Password
        if (empty($data['password'])) {
          $data['password_err'] = 'Please enter your password';
        } elseif (strlen($data['password']) < 6) {
          $data['password_err'] = 'The password must be at least 6 characters';
        }
        // Check for user / email
        if ($this->userModel->findUserByEmail($data['email'])) {
          // User found
        } else {
          // User not found
          $data['email_err'] = 'No user found';
        }
        // Make sure errors are empty
        if (empty($data['email_err']) && empty($data['password_err'])) {
          // Validated
          // Check and set logged in user
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);
          if ($loggedInUser) {
            // Create Session
            $this->createUserSession($loggedInUser);
          } else {
            $data['password_err'] = 'Password incorrect';
            $_SESSION['email'] = $data['email'];
            $_SESSION['password'] = $data['password'];
            $_SESSION['password_err'] = $data['password_err'];
            $_SESSION['email_err'] = $data['email_err'];
            $this->view('pages/index');
          }
        } else {
          // Load view with errors
          $_SESSION['email'] = $data['email'];
          $_SESSION['password'] = $data['password'];
          $_SESSION['password_err'] = $data['password_err'];
          $_SESSION['email_err'] = $data['email_err'];
          $this->view('pages/index');
        }
      } else {
        if (isLoggedIn()) {
          redirect('');
        }
        // Init data
        $data = [
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => ''
        ];
        // Load the view
        $_SESSION['email'] = $data['email'];
        $_SESSION['password'] = $data['password'];
        $this->view('pages/index');
      }
    }

    public function createUserSession ($user) {
      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_email'] = $user->email;
      $_SESSION['user_name'] = $user->name;
      redirect('posts');
    }

    public function logout() {
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      session_destroy();
      redirect('users/login');
    }
  }