<?php
define("DB_HOST","localhost");
define("DB_NAME","animeBlog");
define("DB_USER","root");
define("DB_PASS","");

$link = mysqli_connect(DB_HOST,DB_USER,
                DB_PASS,DB_NAME);
session_start();

mysqli_select_db($link,DB_NAME);