<?php 
    $user = isset($_POST["who"])? htmlentities($_POST["who"]) : '';
    $pass = isset($_POST["pass"])?htmlentities($_POST["pass"]): '' ;  
    $finalPass = hash ("md5", 'XyZzy12*_php123');
    $passHash = hash("md5", 'XyZzy12*_'.$pass);
    $textMessage = "";
    
    if(isset($_POST["cancel"])) header('Location: index.php');

    //print_r($_POST);
    if(isset($_POST["button"])){
    if($user==''||$pass=='') $textMessage = "User name and password are required";
    else {

    if($passHash == $finalPass&&strpos($user, '@')) {
        $textMessage = "";
        header('Location: autos.php?name='.urlencode($_POST["who"]));

    }
    else if(!strpos($user, '@')) $textMessage = "Email must have an at-sign (@)";
    else{ 
        if($pass != '') $textMessage = "Incorrect password";
        //header('Location: login.php');
    }    
    }
    }
?>

<!-- ----------------------------------------------------------------------------------- -->

<!DOCTYPE html>
<head>
    <title>Arush Sharma - Login page</title>
</head>
<body>
<h1>Please Log In</h1>
<p style="color:red;"><?= $textMessage ?></p>
<form method="post">
    User Name <input type="text" name="who" size="20">
    <br>
    Password <input type="password" name="pass" size="20">
    <br>
    <input type="submit" name="button" value="Log In"> 
    <input type="submit" name="cancel" value="Cancel">
</form>
<p> For a password hint, view source and find a password hint in the HTML comments. </p>
<!-- Hint - The password is my php123 -->
</body>
</html>


