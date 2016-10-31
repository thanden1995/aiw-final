<?php
/**
 * Created by PhpStorm.
 * User: Le Tuan Anh
 * Date: 10/29/2016
 * Time: 12:14 AM
 */
namespace server\model;

use PDO;

class Model
{
    /**
     * @param $sql
     * @return \PDOStatement
     * Execute sql query
     */
    public function query($sql)
    {
        $conn = $this->connect();
        try {
            $stmt = $conn->query($sql, PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo("Error < " . $e->getMessage() . " >");
            exit;
        }
        return $stmt;
    }

    public function connect()
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        try {
            $conn = new PDO("mysql:host=$host;dbname=aiw_assignment2;charset=utf8", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return array|mixed
     * return data
     */
    public function returnData($stmt)
    {
        $result = array();
        while ($row = $stmt->fetch()) {
            $result["data"][] = $row;
        }
        $total = count($result["data"]);
        $perPage = 10;
        $result["meta"]["pagination"]["total"] = $total;
        $result["meta"]["pagination"]["perPage"] = $perPage;
        if ($perPage <= $total) {
            $result["meta"]["pagination"]["totalPages"] = round($total / $perPage);
        } else {
            $result["meta"]["pagination"]["totalPages"] = 1;
        }
        return $result;
    }
}