<?php

include_once APPROOT."/libraries/Validate.php";
class Users extends Controller
{

    public function __construct ()
    {
        $this->userModel=$this->model("User");
    }
    public function register()
    {
        //check for POST
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $errorNum=0;
            
            //Process Form 
            $data=[
                "name" =>trim($_POST["name"]),
                "email" =>trim($_POST["email"]),
                "password" =>trim($_POST["password"]),
                "confirm_password" =>trim($_POST["confirm_password"]),
                "errorNum" =>$errorNum,
                "name_err" =>"",
                "email_err" =>"",
                "password_err" =>"",
                "confirm_password_err" =>"",
            ];
            //validate Form Data
            if(Validate::is_Empty($data["name"]))
            {
                $errorNum++;

                $data["name_err"]="Please Enter Name";
            }

            if(Validate::is_Empty($data["email"]))
            {
                $errorNum++;

                $data["email_err"]="Please Enter Email";
            }
            else 
            {
                //check if email exists
                if($this->userModel->findUserByEmail($data["email"]))
                {
                    $errorNum++;
                    $data["email_err"]=" Email is already Taken";
 
                }

            }
            if(Validate::is_Empty($data["password"]))
            {
                $errorNum++;

                $data["password_err"]="Please Enter Password";
            }
            elseif(!Validate::check_len($data["password"],6))
            {
                $errorNum++;

                $data["password_err"]="Password Should be At least 6 Characters!";
            }

            if(Validate::is_Empty($data["confirm_password"]))
            {
                $errorNum++;

                $data["confirm_password_err"]="Please Enter Password Confirmation";
            }
            elseif(!Validate::is_Equal($data["password"],$data["confirm_password"]))
            {
                $errorNum++;

                $data["confirm_password_err"]="Password Not Matches!";
            }
            if($errorNum==0)
            {
                //Hash Password
                $data["password"]=password_hash($data["password"],PASSWORD_DEFAULT);
                if($this->userModel->register($data))
                {
                    //ok
                    flash("register_success","Regiser Successfully");
                    redirect("users/login");
                }
                else
                {
                  // Regiserion error
                  die("db error");
                }
            }
            else
            {
                // error in inpute
                $this->view("users/register",$data);
            }
        }
        else
        {
            //inti data (last  inserted data and errors)
            $data=[
                "name" =>"",
                "email" =>"",
                "password" =>"",
                "confirm_password" =>"",
                "name_err" =>"",
                "email_err" =>"",
                "password_err" =>"",
                "confirm_password_err" =>"",
            ];
            //load form
            $this->view("users/register",$data);
        }
    }
    public function login()
    {
        //check for POST
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            //Process Form
            $errorNum=0;

            $data=[
                "email" =>trim($_POST["email"]),
                "password" =>trim($_POST["password"]),
                "email_err" =>"",
                "password_err" =>"",
                "errorNum" =>$errorNum,

                ];
            //validate Form Data
            if(Validate::is_Empty($data["email"]))
            {
                $errorNum++;

                $data["email_err"]="Please Enter Email";
            }
            else
            {
                //Check for email exist
                if(!$this->userModel->findUserByEmail($data["email"]))
                {
                    $errorNum++;
                    $data["email_err"]=" No User For This Email!";
                }
            }
            if(Validate::is_Empty($data["password"]))
            {
                $errorNum++;

                $data["password_err"]="Please Enter Password";
            }
            if($errorNum==0)
            {
                $logedInUser=$this->userModel->login($data['email'],$data['password']);
                if($logedInUser)
                {
                    //add user data in session
                    $_SESSION["user_id"]=$logedInUser->id;
                    $_SESSION["user_name"]=$logedInUser->name;
                    $_SESSION["user_email"]=$logedInUser->email;
                    //die($_SESSION["user_id"]);
                    flash("login_success","Login Successfully");

                    redirect("pages/index");



                }
                else
                {
                    //passowrd incorrect
                    $data["password_err"]="Password incorrect";
                    $this->view("users/login",$data);


                }

                //echo "ok";
                //ok
            }
            else
            {
                $this->view("users/login",$data);

            }
            

        }
        else
        {
            
            //inti data (last  inserted data and errors)
            $data=[
                "email" =>"",
                "password" =>"",
                "email_error" =>"",
                "password_error" =>""
                ];
            //load form
            $this->view("users/login",$data);


        }


    }
    public function logout(){
        unset( $_SESSION["user_id"]);
        unset( $_SESSION["user_name"]);
        unset( $_SESSION["user_email"]);
        session_destroy();
        redirect("users/login");
    }
    public function isloggedIn()
    {
        return isset($_SESSION["user_id"]) ? true : false;
    }  

}