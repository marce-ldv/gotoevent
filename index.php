<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "config/autoload.php";
require "config/data.php";
require "helpers/session.php";

use config\Autoload as Autoload;
use config\Request as Request;
use config\Router as Router;
use helpers\Session as Session;


Autoload::start();
Router::direccionar(new Request());