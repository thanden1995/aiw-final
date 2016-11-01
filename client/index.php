<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Bootstrap core CSS -->
    <link href="https://fonts.googleapis.com/css?family=Lobster|Merriweather" rel="stylesheet">
    <!-- Custom styles for this template -->
    <title>Student Information</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="row">
    <div class="col-md-8  col-md-offset-2 body">

    </div>
</div>
<script>
    $(document).ready(function () {
        var url = "http://ebz.local/";

        function getApi(url, numPage) {
            $.getJSON(url, function (data) {

                var heading = Object.keys(data.data[0]);
                $(".body").append("<table id='result' class='table'>");

                $("#result").append("<thead><tr>");
                for (var i = 0; i < heading.length; i++) {
                    $("#result").append("<th class='text-left'>" + heading[i].toUpperCase() + "</th>");
                }
                $("#result").append("</tr></thead>");
                $("#result").append("<tbody>");
                $.each(data.data, function (key, val) {
                    $("#result").append("<tr class='text-left '>" + "<td >" + val.student_id + "</td>" + "<td>" + val.name + "</td>" + "<td>" + val.class + "</td>" + "<td>" + val.phone + "</td>" + "<td>" + val.email + "</td>" + "</tr>");
                });
                $("#result").append("</tbody>");
                $(".body").append("</table>");
                var meta = data.meta.pagination;
                var totalPage = meta.totalPage;
                getPaginatioin(totalPage, numPage)
            });
        }

        function getPaginatioin(totalPage, currentPage) {
            $(".body").append("<div id='container-pagination' class='text-center'><ul id='links' class='pagination'>");
            for (var i = 1; i <= totalPage; i++) {
                if (i == currentPage) {
                    $("#links").append("<li class='active'><a class='link'href='#'>" + i + "</a></li>");
                } else {
                    $("#links").append("<li><a class='link'href='#'>" + i + "</a></li>");
                }

            }
            $(".body").append("</ul></div>");
        }

        getApi("http://ebz.local/");
        $(".body").on('click', '.link', function (e) {
            $("#result").remove();
            var numPage = $(e.target).text();
            $("#container-pagination").remove();
            getApi(url + "?page=" + numPage, numPage);
        });
    });
</script>
</body>
</html>




