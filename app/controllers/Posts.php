<?php
class Posts extends Controller
{
    public function __construct()
    {
        if(!isAuth())
        {
            redirect("users/login");
        }
        $this->postModel=$this->model("Post");

    }
    public function index()
    {
        $posts=$this->postModel->getPosts();
        $data=[
            "posts"=>$posts
        ];

        $this->view("Posts/index",$data);
    }
    public function add()
    {
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
        //die($_POST["body"]);

            //Process Form
            $errorNum=0;

            $data = [
                "title" => $_POST["title"],
                 "body" => $_POST["body"],
                 "title_err" =>"",
                 "body_err" =>"",
                  "op" =>"add"

 
                   
              ];
            //validate Form Data
            if(Validate::is_Empty($data["title"]))
            {
                $errorNum++;

                $data["title_err"]="Please Enter Post Title";
            }
            //die($data["body"]);;
            if(!Validate::check_len($data["body"],1))
            {
                

                $errorNum++;

                $data["body_err"]="Please Enter Post Body";
            }
            if($errorNum==0)
            {
                $data["user_id"]=$_SESSION['user_id'];
                if($this->postModel->savePost($data))
                {

                    flash("postAdd_success","Post Saved Successfully");

                    redirect("posts/index");

                }

                //ok
            }
            else
            {
                $this->view("posts/add",$data);

            }
        }
        else
        {
             

        $data = [
          "title" => "",
           "body" => "",
           "title_err" =>"",
           "body_err" =>"",
           "op" =>"add"
        ];
        $this->view("Posts/add",$data);
        }
    }
    public function show($id)
    {
        $post = $this->postModel->getPostById($id);
        if(!empty( $post))
        {
            $data = [
                "post" =>$post
            ];
            $this->view("Posts/show",$data);
        }
        else
        {
            redirect("posts/index");
        }
       
    }
    public  function edit($id)
    {
        $post = $this->postModel->getPostById($id);
        //check post Owner

        if($post->user_id == $_SESSION["user_id"])
        {
            if($_SERVER["REQUEST_METHOD"]=="POST")
            {

                $errorNum=0;
                 $data = [
                    "title" => trim( $_POST["title"]),
                     "body" => trim($_POST["body"]),
                     "title_err" =>"",
                     "body_err" =>"",
                      "op" =>"add"
                    ];
                 //validate Form Data
                if(Validate::is_Empty($data["title"]))
                {
                    $errorNum++;
                    $data["title_err"]="Please Enter Post Title";
                }
                if(!Validate::check_len($data["body"],1))
                {
                    $errorNum++;
                    $data["body_err"]="Please Enter Post Body";
                }
                if($errorNum == 0)
                {
                    $data["post_id"] = $post->posId;
                    if ($this->postModel->editPost($data))
                    {
                        flash("postAdd_success","Post Saved Successfully");
                        redirect("posts/index");
                    }
                }
                else
                {
                    //db error
                    $this->view("posts/add",$data);
                }
            }
            else
            {
                // Load Edit Form
                $data = [
                    "post_id" => $post->posId,
                    "title" => $post->title,
                    "body" => $post->body,
                    "title_err" =>"",
                    "body_err" =>"",
                    "op" =>"add"
                ];
                $this->view("Posts/edit",$data);
            }
        }
        else
        {
            redirect("posts/index");
        }

    }
    public  function delete($id)
    {
        $post = $this->postModel->getPostById($id);
        if($post->user_id == $_SESSION["user_id"])
        {
            $this->postModel->deletPost($id);
        }
            redirect("posts/index");
        }
   

}