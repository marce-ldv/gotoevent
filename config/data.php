<?php

namespace config;


define("DB_NAME", "dbusers");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_HOST", "localhost");

//Constantes front
define('ROOT',  dirname(__DIR__));
define('FRONT_ROOT', '/gotoevent');
define('ADMIN_FRONT_ROOT', FRONT_ROOT . '/admin');
define("VIEWS",  ROOT . '/views');
define("URL_CSS", FRONT_ROOT . '/content/css');
define("URL_JS", FRONT_ROOT . '/content/js');
define("URL_IMG", FRONT_ROOT . '/content/img');
define("IMAGE_UPLOADS", FRONT_ROOT . '/content/uploads');
define("URL_VENDOR", FRONT_ROOT . '/content/vendor');
define("URL_BOOTSTRAP", FRONT_ROOT . '/content/css/bootstrap.min.css');
define("NODE_DIR", FRONT_ROOT . "/node_modules");
define("JQUERYJS", NODE_DIR . "/jquery/dist/jquery.min.js");
define("BOOTSTRAPJS", NODE_DIR . "/bootstrap/dist/js/bootstrap.min.js");
define("BOOTSTRAPCSS", NODE_DIR . "/bootstrap/dist/css/bootstrap.min.css");
define("FONTAWESOME_CSS", NODE_DIR . "/@fortawesome/fontawesome-free/css/all.css");
define("FONTAWESOME_JS", NODE_DIR . "/@fortawesome/fontawesome-free/js/all.js");
