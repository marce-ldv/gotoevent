<?php

namespace controllers;
use model\User as User;
use helpers\Session as Session; 

class Controller{

  protected $session;

  public function __construct(){
    $this->session = Session::getInstance();
  }

  public function getToken(){
    if( ! isset($this->session->token))
    return false;

    $user = new User();
    $user->unserialize($this->session->token);
    return $user;
  }

  public function isLogged(){
    return ($this->getToken() ? true : false);
  }

  //TODO: Modificar redirect, debe redirigir a el metodo de la controladra de la vista, ejemplo Default/Index
  public function redirect($url, $options = []){
    /*
    if (! empty($options)) {
      $optionsSerialize = serialize($options);
      $this->session->redirectOptions = $optionsSerialize;
    }
    //redirect

    header("location: ". FRONT_VIEW . $url);*/
  }

  public function render($path, $options = []) {

    //Revisa la session por options de redirect
    if ( $this->session->redirectOptions ) {
      $optionsUnserialize = unserialize($this->session->redirectOptions);
      unset($this->session->redirectOptions);
      $options = array_merge($optionsUnserialize, $options);
    }

    if ( ! empty($options)) {
      forEach($options as $key => $value) {
        ${$key} = $value;
      }
    }

    include VIEWS . '/header.php';
    require(VIEWS . "/$path" . ".php");
    //include VIEWS . '/footer.php';
  }

  public function isMethod ($method) {
    return $_SERVER["REQUEST_METHOD"] == $method;
  }


}
