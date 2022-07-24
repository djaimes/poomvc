<?php
/**
 * El modelo va en singular y su controlador en plural
 */

class Post{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getPosts(){
        $this->db->query("SELECT * FROM posts");
        return $this->db->resultSet();
    }
}
?>