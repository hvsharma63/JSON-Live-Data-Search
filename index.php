<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Live Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <form method="post">    
            <div class="col-md-6 offset-md-3 mt-5">
                <input type="text" class="form-control form-control-lg" id="searchbar" placeholder="Search the Name">
            </div>
            <ul class="list-group" id="result"></ul>
        </form>
    </div>    
</body>
</html>
<script>
    $(document).ready(function() {
        $.ajaxSetup({ cache: false });
        $("#searchbar").keyup(function(){
            $("#result").html("");
            $("#state").val("");
            var searchField = $("#searchbar").val();
            var expression = new RegExp(searchField, "i");
            $.getJSON("document.json", function(data){
                $.each(data, function(key, value){
                    if(value.name.search(expression) != -1 || value.location.search(expression) != -1){
                        $("#result").append("<li class='list-group-item'> "+value.name+" | "+value.age+", "+value.location+" </li>")
                    }
                });
            });
        });
        $("#result").on("click","li", function () {
            var click_text = $(this).text().split('|');
            $("#searchbar").val($.trim(click_text[0]));
            $("#result").html("");
        });
    });
</script>