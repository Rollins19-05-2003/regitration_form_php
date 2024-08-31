<?php
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
        <h1>Regsitration form</h1>
        <label for="email">Email</label>
        <input type="email" name="email" id="email"/><br>

        <label for="password">Password</label>
        <input type="password" name="password" id="password"/><br>

        <input type="submit" name="submit" value="register">
    </form>
</body>
</html>

<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if(empty($email)){
        echo "Please enter your email";
    }elseif(empty($password)){
        echo "Please enter your password";
    }else{
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, password) VALUES ('$email','$hash')";
        try{
            mysqli_query($conn, $sql);
            echo "Registration successful";
        }catch(mysqli_sql_exception){
            echo "Registration Failed" . mysqli_error($conn);
        }

    }
}
    mysqli_close($conn) ;
?>