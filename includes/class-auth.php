<?php

class Auth{
    
    public function login()
    {
        // init DB class
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
    }

    public function signup()
    {
        $db = new DB();

        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        $user = $db->fetch(
            "SELECT * FROM users where email = :email",
            [
    
            'email' => $email
    
            ]
        );

        if(empty($name) || empty($email) || empty($password) || empty($confirm_password)){
            $error = 'Please enter field';
        } else if ($password !== $confirm_password){
            $error = 'Please check your password';
        } else if(strlen($password) < 8){
            $error = 'Must be 8 characters';
        }

        if (isset ($error)){
            $_SESSION['error'] = $error;
            header("Location: /sign_up");
            exit;
        }
        
            $sql = 'INSERT INTO users (`name` , `email` , `password`)
                VALUES (:name, :email, :password)';

            $db->insert($sql, [
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]);

            header("Location: /login");
            exit;
        
    }

    public function logout()
    {
        unset( $_SESSION['user'] );

        header("Location: /");
        exit;
    
    }
}
?>
