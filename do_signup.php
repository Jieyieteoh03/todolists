<?php
    session_start();

    $database = new PDO(
    "mysql:host=devkinsta_db;dbname=todolist",
    "root",
    "LrJHyxBK8VE6Afq8");

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if(empty($name) || empty($email) || empty($password) || empty($confirm_password)){
        echo 'Please enter field';
    } else if ($password !== $confirm_password){
        echo 'Please check your password';
    } else if(strlen($password) < 8){
        echo 'Must be 8 characters';
    } else {
        $sql = 'INSERT INTO users (`name` , `email` , `password`)
            VALUES (:name, :email, :password)';

        $query = $database->prepare($sql);

        $query->execute([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        header("Location: index.php");
        exit;
    }

?>