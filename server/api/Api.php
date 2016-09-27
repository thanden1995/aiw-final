<?php
namespace server\api;
include("model\DB.php");
use server\model\DB;

class Api
{
    public function getNews()
    {
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");
        header('Content-type: application/json');
        $db = new \server\model\DB();
        $data = $db->selectTopNews();
        $hotNews=$data[0];
        unset($data[0]);
        $result= array();
        $result["data"]=$data;
        $result["hot-news"]=$hotNews;
        return json_encode($result);
    }

    public function getNewsBySlug($slug)
    {
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");
        header('Content-type: application/json');
        $db = new \server\model\DB();
        $result = array();
        $result [] = $db->selectNewsBySlug($slug);
        $result ["related"] = $db->selectRelateNews($slug,$result[0]["id"],$result[0]["category_id"]);
        return json_encode($result);
    }
}

$api = new Api();
$api->getNews();