<?php
class Post
{
    private $db;
    public function __construct()
    {
        $this->db=new Database;
    }
    public function getPosts()
    {
        $this->db->query("select * , posts.id as posId , 
                         users.id as userId ,
                         posts.created_at as postCreated,
                         users.created_at as userCreatedDate
                         from posts
                         inner join users
                         on posts.user_id =users.id
                         order by posts.created_at DESC");
        $results = $this->db->resultSet();
        return $results;

    }
    public function getPostById($id)
    {
        //die($id);
        $this->db->query("select * , posts.id as posId , 
        users.id as userId ,
        posts.created_at as postCreated,
        users.created_at as userCreatedDate
        from posts
        inner join users
        on posts.user_id = users.id
        where posts.id = :id
        order by posts.created_at DESC");
        $this->db->bind('id',$id);

        $row = $this->db->single();
        return $row;
        }
    public function savePost($data)
    {
        $title=$data["title"];
        $body=$data["body"];
        $user_id=$data["user_id"];

        $this->db->query("insert into posts (user_id,title,body) VALUES (:user_id, :title, :body)");
        //bind vaules
        $this->db->bind('user_id',$user_id);
        $this->db->bind('title',$title);
        $this->db->bind('body',$body);
        if($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }

    }
    public function editPost($data)
    {
        $title=$data["title"];
        $body=$data["body"];
        $body=$data["body"];
        $post_id=$data["post_id"];

        $this->db->query("UPDATE posts SET title = :title , body = :body WHERE id =:id");
        //bind vaules
        $this->db->bind('id',$post_id);
        $this->db->bind('title',$title);
        $this->db->bind('body',$body);
        if($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }

    }
    public function deletPost($id)
    {
        $this->db->query("DELETE FROM `posts` WHERE id = :id");
        //bind vaules
        $this->db->bind('id',$id);
        if($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

   
 
}
