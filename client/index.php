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
            <style type="text/css">
                body{
                    margin-top: 100px;
                }
            </style>
</head>
<body>
<!-- <div class="row">
	<div class="col-md-2 search">
		<div id="alert">
			
		</div>
		<input type="text" id="search-student">
	</div>
    <div class="col-md-8 body">

    </div>
</div> -->
 <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Help</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" id="search-student" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Analytics</a></li>
            <li><a href="#">Export</a></li>
          </ul>
        </div>
        <div class="col-md-10 main">
        
          <h2 class="sub-header">Section title</h2>
          <div id="alert">
            
          </div>
          <div class="table-responsive">
            
          </div>
        </div>
      </div>
    </div>


































<script>
    $(document).ready(function () {
        var url = "http://ebz.local/student";
        function getApi(url, numPage) {
            $.getJSON(url, function (data) {
            	console.log(data);
                var heading = Object.keys(data.data[0]);
                $(".table-responsive").append("<table id='result' class='table table-striped'>");

                $("#result").append("<thead><tr class='head'>");
                for (var i = 0; i < heading.length; i++) {
                    $(".head").append("<th class='text-left'>" + heading[i].toUpperCase() + "</th>");
                }
                $("#result").append("</tr></thead>");
                $("#result").append("<tbody>");
                $.each(data.data, function (key, val) {
                    $("#result").append("<tr class='text-left '>" + "<td >" + val.student_id + "</td>" + "<td>" + val.name + "</td>" + "<td>" + val.class + "</td>" + "<td>" + val.phone + "</td>" + "<td>" + val.email + "</td>" + "</tr>");
                });
                $("#result").append("</tbody>");
                $(".table-responsive").append("</table>");
                var meta = data.meta.pagination;
                var totalPage = meta.totalPage;
                getPaginatioin(totalPage, numPage)
            });
        }
        function getDetailApi(url){
        	$.getJSON(url, function (data) {
        		if(data==""){
        			$("#alert p").remove();
        			$("#alert").append("<p>Not Found</p>")
        		}else{
        			$("#alert p").remove();
        			var heading = Object.keys(data.data[0]);
	                $(".table-responsive").append("<table id='result' class='table table-striped'>");

	                $("#result").append("<thead><tr class='head'>");
	                for (var i = 0; i < heading.length; i++) {
	                    $(".head").append("<th class='text-left'>" + heading[i].toUpperCase() + "</th>");
	                }
	                $("#result").append("</tr></thead>");
	                $("#result").append("<tbody>");
	                $.each(data.data, function (key, val) {
	                    $("#result").append("<tr class='text-left '>" + "<td >" + val.student_id + "</td>" + "<td>" + val.name + "</td>" + "<td>" + val.class + "</td>" + "<td>" + val.phone + "</td>" + "<td>" + val.email + "</td>" + "</tr>");
	                });
	                $("#result").append("</tbody>");
	                $(".table-responsive").append("</table>");
        		}
            });
        }
        function getPaginatioin(totalPage, currentPage) {
            $(".table-responsive").append("<div id='container-pagination' class='text-center'><ul id='links' class='pagination'>");
            for (var i = 1; i <= totalPage; i++) {
                if (i == currentPage) {
                    $("#links").append("<li class='active'><a class='link'href='#'>" + i + "</a></li>");
                } else {
                    $("#links").append("<li><a class='link'href='#'>" + i + "</a></li>");
                }

            }
            $(".table-responsive").append("</ul></div>");
        }

        getApi("http://ebz.local/", 1);
        $(".table-responsive").on('click', '.link', function (e) {
            $("#result").remove();
            var numPage = $(e.target).text();
            $("#container-pagination").remove();
            getApi(url + "?page=" + numPage, numPage);
        });
        $("#search-student").keyup(function(e){
        	var input = $("#search-student").val();
        	if(input.length==10){
        		$("#result").remove();
	            $("#container-pagination").remove();
        		getDetailApi(url+"/"+input);
        	}else if(input.length==0){
                $("#result").remove();
                $("#container-pagination").remove();
                getApi("http://ebz.local/", 1);
            }
        });
    });
</script>
</body>
</html>




