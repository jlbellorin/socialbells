<?php
  class Posts extends Controller {
    public function __construct () {
      if (!isLoggedIn()) { redirect('users/login'); }
      $this->postModel = $this->model('Post');
      $this->userModel = $this->model('User');
      if (!isset($_SESSION['errors'])) { $_SESSION['errors'] = ''; }
    }

    public function index () {
      $posts = $this->postModel->getPosts();
      $data = [ 'body' => '', 'posts' => $posts ];
      $this->view('posts/index', $data);
    }

    public function add () {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize the post
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [ 'body' => trim($_POST['body']), 'user_id' => $_SESSION['user_id'] ];
        // Making sure there are no errors
        if (!empty($data['body'])) {
          if ($this->postModel->addPost($data)) {
            flash('post_message', 'Post Added');
            redirect('posts');
          } else { die('Something went wrong'); }
        }
      }
    }

    public function delete($id) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $post = $this->postModel->getPostById($id);
        // Check for owner
        if ($post->user_id != $_SESSION['user_id']) { redirect('posts'); }
        if ($this->postModel->deletePost($id)) {
          flash('success_msg', 'Post Removed');
          redirect('posts');
        } else { die('Something went wrong'); }
      } else { redirect('posts'); }
    }
  }