<?php
namespace server\api;

use server\model\Contact;

include($_SERVER['DOCUMENT_ROOT'] . "/model/Contact.php");

class Api
{
    public $model;

    public function __construct()
    {
        $this->model = new Contact();
    }

    public function index($page)
    {
        $result = array();
        $data = $this->model->getAllStudent();
        if ($page <= $data["meta"]["pagination"]["totalPage"]) {
            $result = $this->paginate($data, $page);
        }
        return $this->transferData($result);

    }

    public function paginate($data, $page)
    {
        $result = array();
        $start = $data["meta"]["pagination"]["perPage"] * ($page - 1);
        if ($page == $data["meta"]["pagination"]["totalPage"]) {
            $end = $data["meta"]["pagination"]["total"] - 1;
        } else {
            $end = $data["meta"]["pagination"]["perPage"] * $page - 1;
        }
        for ($i = $start; $i <= $end; $i++) {
            $result["data"][] = $data["data"][$i];
        }
        $result["meta"] = $data["meta"];
        $result["meta"]["pagination"]["currentPage"] = $page;
        if ($page == 1) {
            $result["meta"]["pagination"]["link"]["next"] = "http://ebz.local/student?page=" . ($page + 1);
        } else if ($page == $result["meta"]["pagination"]["totalPage"]) {
            $result["meta"]["pagination"]["link"]["previous"] = "http://ebz.local/student?page=" . ($page - 1);
        } else {
            $result["meta"]["pagination"]["link"]["next"] = "http://ebz.local/student?page=" . ($page + 1);
            $result["meta"]["pagination"]["link"]["previous"] = "http://ebz.local/student?page=" . ($page - 1);
        }
        return $result;
    }

    public function transferData($result)
    {
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function show($id)
    {
        $result = $this->model->getStudentById($id);
        return $this->transferData($result);

    }

}