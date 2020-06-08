<?php
$connect = new PDO('mysql:host=localhost;dbname=comment', 'root', '');
foreach ($connect->query('SELECT COUNT(*) FROM tbl_comment where parent_comment_id=0') as $row) {
    $a =  $row['COUNT(*)'];
}
foreach ($connect->query('SELECT COUNT(*) FROM tbl_comment where parent_comment_id!=0') as $row) {
    $b =  $row['COUNT(*)'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Comment System using PHP and AJAX.">
    <meta name="author" content="Pardeep Kumar">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comment System</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <style>
        .container {
            padding-top: 70px;
        }

        .navbar {
            box-shadow: 0 0 4px 4px rgb(110, 110, 110);
        }

        body {
            margin-bottom: 60px;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="comment.php"><b>Comments</b></a>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto mr-5">
            </ul>
        </div>
    </nav>
    <div class="container">
        <h3>Comment Here:</h3>
        <hr>
        <form method="POST" id="comment_form">
            <div class="form-group">
                <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="comment_id" id="comment_id" value="0">
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>

        <span id="comment_message"></span>
        <br>
        <div class="alert alert-dark" role="alert">
            <span type="button" class="btn btn-sm btn-light">
                Comments <span class="badge badge-pill badge-secondary"><?php echo $a; ?></span>
            </span>
            <span type="button" class="btn btn-sm btn-light float-right">
                Reply <span class="badge badge-pill badge-secondary"><?php echo $b; ?></span>
            </span>
        </div>
        <div id="display_comment"></div>

    </div>

</body>

</html>

<script>
    $(document).ready(function() {

        $('#comment_form').on('submit', function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "add_comment.php",
                method: "POST",
                data: form_data,
                dataType: "JSON",
                success: function(data) {
                    if (data.error != '') {
                        $('#comment_form')[0].reset();
                        $('#comment_message').html(data.error);
                        $('#comment_id').val('0');
                        load_comment();
                    }
                }
            })
        });

        load_comment();

        function load_comment() {
            $.ajax({
                url: "fetch_comment.php",
                method: "POST",
                success: function(data) {
                    $('#display_comment').html(data);
                }
            })
        }

        $(document).on('click', '.reply', function() {
            var comment_id = $(this).attr("id");
            $('#comment_id').val(comment_id);
            $('#comment_name').focus();
        });

    });
</script>