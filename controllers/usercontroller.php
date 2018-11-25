<?php

namespace controllers;
use model\User as User;
use controllers\FileCcontroller as FileController;
use controllers\Controller as Controller;
use dao\UserDAO as UserDAO;

class UserController extends Controller{
  private $userDAO;

  public function __construct () {
    parent::__construct();
    $this->userDAO = new UserDAO();
  }

  public function index(){
    return;
  }


  public function register ($registerData = []) {

    if ( ! $this->isMethod("POST")) $this->redirect("/default/");
    if (empty($registerData)) $this->redirect("/default/");

    //$fileController = new FileController(); 

    if ($this->userDAO->readByUsernameOrEmail([
      "user" => $registerData["username"],
      "email" => $registerData["email"]
      ])) {
       //$this->redirect("/default/", ["alert" => "El usuario o email ya estan registrados"]);
       return;
     }

    if ($registerData["pass"] != $registerData["passAgain"]) {
      $this->redirect("/default/", ["alert" => "Las contraseñas no coinciden"]);
      return;
     }

    $hash = password_hash($registerData["pass"],PASSWORD_DEFAULT);

    $user = new User(
      $registerData["role_user"],
      $registerData["username"],
      $hash,
      $registerData["email"],
      $registerData["name_user"],
      $registerData["surname"],
      $registerData["dni"],
      $registerData["profilePicture"]
    );

    //$fileController->upload($registerData["profilePicture"]);
    //print_r($user);
    try {
      $this->userDAO->create($user);
      $this->redirect ('/default/', ["alert" => "Usuario creado con exito"]);
      return true;
    } catch (\Throwable $th) {
      throw $th;
    }

    return false;
  }

  public function add($_user) {

    $D_user = new D_User();

    $fileController = new FileController();

    // Si se sube con exito la imagen...
    //if($fileController->upload($_user->getAvatar(), 'avatar')) {

        try {
              $D_user->create($_user);
              return true;
        } catch(\PDOException $ex) {
              throw $ex;
        }

    //} else {
    //    return false;
    //}

  }

  //login

  public function login($registerData = []){
    if ( ! $this->isMethod("POST")) $this->redirect("/default/");
    if (empty($registerData)) $this->redirect("/default/");

    if( ! $user = $this->userDAO->readByUser($registerData["username"]) ) {
        $this->redirect('/default/',[
        'queMierdaPasa' => "PAsa algo en readByUser"
      ]);
      return;
      }
      $user = $this->userDAO->mapMethod($user);
      if( ! password_verify($registerData["pass"],$user->getPass()) ){
      $this->redirect('/default/',[
        'alert' => "Password incorrecta"
      ]);
      return ;
    }

    $this->session->token = $user->serialize();

    $this->redirect('/default/dashboard/');

  }

  public function logout()
  {
    $this->session->destroy();
    $this->redirect('/');
  }


}
