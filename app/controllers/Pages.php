<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
      //die("index");

      $data = [
        'title' => 'SharePosts',
        "description"=>"simple Social Network"

      ];
     
      $this->view('pages/index', $data);
    }
   
    public function about(){
      //die("about");

      $data = [
        'title' => 'About Us',
        "description"=>"simple Social Network"
      ];

      $this->view('pages/about', $data);
    }
  }