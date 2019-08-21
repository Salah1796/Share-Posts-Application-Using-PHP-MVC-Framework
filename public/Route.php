<?php
//add routes here
 //require_once '../app/bootstrap.php';
 $route= Route::getInstance(); //do not remove  this line
 $route->add("/home",["controller"=>"home","action"=>"index"]);
 $route->add("/about",["controller"=>"pages","action"=>"about"]);

 //print_r($route->getRoutes());
 