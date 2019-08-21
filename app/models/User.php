<?php
class User
{
    private $db;
    public function __construct()
    {
        $this->db=new Database;
    }
    public function findUserByEmail($email)
    {
        $this->db->query("select * from users where email = :email");
        $this->db->bind('email',$email);
        $row=$this->db->single();
        //check Row
        if($this->db->rowCount()>0)
        {
            //user email exists
            return true;
        }
        return false;


    }
    public function register($data)
    {
        $name=$data["name"];
        $email=$data["email"];
        $password=$data["password"];

        $this->db->query("insert into users (name,email,password) VALUES (:name, :email, :password)");
        //bind vaules
        $this->db->bind('name',$name);
        $this->db->bind('email',$email);
        $this->db->bind('password',$password);
        if($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }

       
    }


    public function login($email,$password)
    {
        $this->db->query("select * from users where email = :email");
        $this->db->bind('email',$email);
        $row=$this->db->single();
        $hashedPassword=$row->password;
        if(password_verify($password,$hashedPassword))
        {
            return $row;
        }
        return false;
    }
 
}
