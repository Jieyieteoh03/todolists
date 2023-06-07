<?php

    $db = new DB();

    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)){
        $error = 'Please enter required field';
    }else{
        // OOP method

        $user = $db->fetch(
            "SELECT * FROM users WHERE email = :email",
            [
                'email' => $email
            ]
            );

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