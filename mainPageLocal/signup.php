<?php
require_once "config.php";

require "signup.html";
?>

<?php
if (isset($_REQUEST['submitSignUp'])) {
    $emailSignUp = $_GET['emailSignUp'];
    $passwordSignUp = $_GET['passwordSignUp'];
    $sqlCheck = mysqli_query($link,
        "SELECT email FROM users
    WHERE email = '$emailSignUp'");
    if (mysqli_num_rows($sqlCheck) == 0) {
        $sql = mysqli_query($link,
            "INSERT INTO users(email,password)
    VALUES('$emailSignUp','$passwordSignUp')");
        header("location:verifyAccount.html");
    }
}
?>
