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

    public function index()
    {
        $result = $this->model->getAllStudent();
        return $this->transferData($result);
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