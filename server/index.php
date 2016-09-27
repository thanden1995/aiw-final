
<?php
include("api/Api.php");


if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET["id"])) {

    } else if (isset($_GET["slug"])) {
        $api = new server\api\Api();
        echo $api->getNewsBySlug($_GET["slug"]);

    } else {
        $api = new server\api\Api();
        echo $api->getNews();
    }
}
?>
