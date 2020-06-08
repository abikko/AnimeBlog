<?php

$connect = new PDO('mysql:host=localhost;dbname=comment_system', 'root', '');

$query = "
SELECT * FROM tbl_comment 
WHERE parent_comment_id = '0' 
ORDER BY comment_id DESC
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach ($result as $row) {
    $output .= '

        <div class="card my-1">
            <div class="card-header">
                By <b style="color:#007bff;">' . $row["comment_sender_name"] . '</b> on ' . $row["date"] . '
            </div>
            <div class="card-body">
                <p class="card-text">' . $row["comment"] . '</p>
            </div>
            <div class="card-footer text-muted">
                <button type="button" class="btn btn-primary btn-sm float-right reply" id="' . $row["comment_id"] . '">Reply</button>
            </div>
        </div>

 ';
    $output .= get_reply_comment($connect, $row["comment_id"]);
}

echo $output;

function get_reply_comment($connect, $parent_id = 0, $marginleft = 0)
{
    $query = "
 SELECT * FROM tbl_comment WHERE parent_comment_id = '" . $parent_id . "'
 ";
    $output = '';
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $count = $statement->rowCount();
    if ($parent_id == 0) {
        $marginleft = 0;
    } else {
        $marginleft = $marginleft + 48;
    }
    if ($count > 0) {
        foreach ($result as $row) {
            $output .= '

        <div class="card my-1" style="margin-left:' . $marginleft . 'px;">
            <div class="card-header">
                By <b style="color:#007bff;">' . $row["comment_sender_name"] . '</b> on ' . $row["date"] . '
            </div>
            <div class="card-body">
                <p class="card-text">' . $row["comment"] . '</p>
            </div>
            <div class="card-footer text-muted">
                <button type="button" class="btn btn-primary btn-sm float-right reply" id="' . $row["comment_id"] . '">Reply</button>
            </div>
        </div>

   ';
            $output .= get_reply_comment($connect, $row["comment_id"], $marginleft);
        }
    }
    return $output;
}
