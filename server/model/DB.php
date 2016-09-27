<?php
namespace server\model;

use \PDO;

class DB
{
    public function connect()
    {
        $host = "mysql.hostinger.vn";
        $user = "u869657210_5c13";
        $password = "ditmemay1";
        try {
            $conn = new PDO("mysql:host=$host;dbname=u869657210_aiw;charset=utf8", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function createNews($title, $content, $short_des, $slug, $category_id)
    {
        try {
            $sql = " INSERT INTO `news` (`id`, `title`, `short_des`, `content`, `create_date`, `category_id`, `slug`, `thumb`) VALUES (NULL,'$title','$short_des','$content',CURRENT_TIMESTAMP,'1','$slug','')";
            $conn = $this->connect();
            $num = $conn->exec($sql);
            echo$sql;
        } catch (PDOException $e) {
            var_dump($sql . "<br>" . $e->getMessage()) ;
            exit;

        }


    }

    public function selectTopNews()
    {
        $conn = $this->connect();
        $stmt = $conn->query("SELECT * FROM news ORDER BY news.create_date desc limit 5");
        $result = array();
        while ($row = $stmt->fetch()) {
            $result[] = $row;
        }
        $a= utf8_encode($result[0]["content"]);

        return $result;
    }

    public function selectNewsBySlug($slug)
    {
        $conn = $this->connect();
        $stmt = $conn->query("SELECT * FROM news where news.slug='$slug'");
        $row = $stmt->fetch();
        return $row;
    }

    public function selectRelateNews($slug, $id, $catId)
    {
        $conn = $this->connect();
        $stmt = $conn->query("SELECT * FROM `news` WHERE news.category_id=$catId AND news.id!=$id ORDER BY news.create_date LIMIT 5");
        $result = array();
        while ($row = $stmt->fetch()) {
            $result[] = $row;
        }
        return $result;
    }
}

$db= new DB();
$db->selectTopNews();