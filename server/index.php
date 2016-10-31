<?php
use server\api\Api;

include($_SERVER['DOCUMENT_ROOT'] . "/controller/Api.php");
$api = new Api();
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET["id"])) {
        $result = $api->show($_GET['id']);
        echo $result;
    } else {
        if (isset($_GET["page"])) {
            $page = $_GET["page"];

        } else {
            $page = 1;
        }
        $result = $api->index($page);
        echo $result;
    }
}
?>
