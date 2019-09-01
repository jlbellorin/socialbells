<?php
  /*
  * App Core Class
  * Creates URL & loads core controller
  * URL Format - /controller/method/params
  */
  class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
      $url = $this->getUrl();

      // Looks in controllers for first value of the URL
      if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
        // If exists, sets as controller
        $this->currentController = ucwords($url[0]);
        // Unsets 0 index
        unset($url[0]);
      }

      // Require the controller
      require_once '../app/controllers/' . $this->currentController . '.php';

      // Instantiate controller
      $this->currentController = new $this->currentController;

      // Check for second part of the URL
      if (isset($url[1])) {
        // Checks to see if the method exists
        if (method_exists($this->currentController, $url[1])) {
          $this->currentMethod = $url[1];
          // Unset index 1
          unset($url[1]);
        }
      }

      // Get params
      $this->params = $url ? array_values($url) : [];

      // Call a callback with array of params
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
      if (isset($_GET['url'])) {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
      }
    }
  }