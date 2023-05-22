<?php
    session_start();

    $database = new PDO (
    "mysql:host=devkinsta_db;dbname=todolist",
    "root",
    "LrJHyxBK8VE6Afq8");

    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)){
        $error = 'Please enter required field';
    }else{
        $sql = "SELECT * FROM users WHERE email = :email";

        $query = $database->prepare($sql);

        $query->execute([
            'email' => $email
        ]);

        $user = $query->fetch();

        if(empty($user)){
            $error = 'Email doesnt exist';
        }else{
            if(password_verify($password,$user['password'])){
                $_SESSION['user'] = $user;

                header("Location: /");
                exit;
            }else{
                $error = 'Password incorrect';
            }
        }
    }

    if (isset ($error)){
        $_SESSION['error'] = $error;
        header("Location: /login");
        exit;
    }
?>