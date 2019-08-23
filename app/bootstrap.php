<?php
  // Load Config
  require_once 'config/config.php'; //Constants
 
  // Load Helper 
  require_once 'helpers/url_help.php'; // Helper Functions
  require_once 'helpers/session_help.php';

  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
  });
  require_once '../public/Route.php';

  
