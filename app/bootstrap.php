<?php
  // Load Config
  require_once 'config/config.php';

  require_once 'helpers/url_help.php';
  require_once 'helpers/session_help.php';

  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
  });
  require_once '../public/Route.php';

  
