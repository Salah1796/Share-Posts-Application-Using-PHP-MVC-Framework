<?php
  /*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */
  class Core {
    public function __construct(){
      $url=$this->getUrl();
      $route= Route::getInstance($url);
 //die($url);
     // if($route->match())
       // {
          //echo $url;
          $url = explode('/', $url);
          $route->getControllerAndAction($url);

          //return $url;
       // }
        //else
        //die("Route Not Found");
       }
       public function getUrl()
    {
      if(isset($_GET['url']))
      {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return $url;
        
      }
    }
  } 