<?php
use server\api\Api;

include($_SERVER['DOCUMENT_ROOT'] . "/controller/Api.php");
$api = new Api();
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET["id"])) {
        $result = $api->show($_GET['id']);
        echo $result;
    } else {
        $result = $api->index();
        echo $result;
    }
}
?>
