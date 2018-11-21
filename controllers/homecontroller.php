<?php

namespace controllers;
use controllers\Controller as Controller;

class HomeController extends Controller{

  public function index(){
    $this->render('home');
  }

  public function dashboard(){
    $this->render('dashboard');
  }
  
}
