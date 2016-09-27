<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
</head>

<body>


<p>The police said that they had recovered a loaded gun with Mr. Scott’s DNA on it, and that he was wearing an ankle
    holster. They did not reveal where they had found the gun.</p>
<?php
include("DB.php");
$db = new server\model\DB();
$a= $db->selectTopNews();
var_dump(json_encode($a));
?>
</body>
</html>
