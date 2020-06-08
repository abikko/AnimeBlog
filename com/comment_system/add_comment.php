<?php

$connect = new PDO('mysql:host=localhost;dbname=comment_system', 'root', '');

$error = '';
$comment_name = '';
$comment_content = '';

if (empty($_POST["comment_name"])) {
    $error .= '

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Name is required *
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    
    ';

} else {
    $comment_name = $_POST["comment_name"];
}

if (empty($_POST["comment_content"])) {
    $error .= '

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Comment is required *
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

    ';
} else {
    $comment_content = $_POST["comment_content"];
}

if ($error == '') {
    $query = "
 INSERT INTO tbl_comment 
 (parent_comment_id, comment, comment_sender_name) 
 VALUES (:parent_comment_id, :comment, :comment_sender_name)
 ";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':parent_comment_id' => $_POST["comment_id"],
            ':comment'    => $comment_content,
            ':comment_sender_name' => $comment_name
        )
    );
    $error = '

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Comment Added Successfully..!!!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    
    ';
}

$data = array(
    'error'  => $error
);

echo json_encode($data);
