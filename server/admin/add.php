<html>
<head>
    <meta charset="utf-8">
    <title>A Simple Page with CKEditor</title>
    <!-- Make sure the path to CKEditor is correct. -->
    <script src="resource/ckeditor/ckeditor.js"></script>
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <p>Title: </p>
    <input type="text" name="title">

    <p>Short des:</p>
    <textarea name="short_des" id="short_des" rows="10" cols="80"></textarea>

    <p>Content</p>
    <textarea name="content" id=content" rows="10" cols="80">
    </textarea>
    <script>
        CKEDITOR.replace('content');
        CKEDITOR.replace('short_des')
    </script>
    <input type="submit" name="submit">
</form>
</body>
</html>
<?php
use server\model\DB;

include("../model/DB.php");
if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $short = $_POST["short_des"];
    $text = preg_replace('~[^\pL\d]+~u', '-', "Yielding to Pressure, Charlotte Releases Videos of Keith Scott Shooting");
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
// remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
// trim
    $text = trim($text, '-');
// remove duplicate -
    $text = preg_replace('~-+~', '-', $text);
// lowercase
    $text = strtolower($text);
    $slug = $text;
    $db = new DB();
    $db->createNews($title, $content, $short, $slug, 1);
    echo $text;
}
?>
