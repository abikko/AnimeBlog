<?php
require_once "config.php";
require "login.html";
?>

<?php
if(isset($_REQUEST['submitLogin'])){
    if($_POST['emailLogin']=='abikzh@gmail.com' && $_POST['passwordLogin'] == 'abyl123'){
        $_SESSION['admin'] = true;
        header("Location: MainPage2.html");
    }
    else{
        $emailLogin = $_POST['emailLogin'];
        $passwordLogin = $_POST['passwordLogin'];
        $sql = mysqli_query($link,
        "SELECT * FROM `users` 
        WHERE email = '$emailLogin' AND password = '$passwordLogin'");
        if(mysqli_num_rows($sql) == 1){
            $_SESSION['admin'] = false;
            header("Location:MainPage2.html");
        }
    }
}
?>
