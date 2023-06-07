<?php

    session_start();

     // require all the functions files
     require "includes/class-db.php";
     require "includes/class-auth.php";
     require "includes/class-task.php";

    $path = parse_url( $_SERVER["REQUEST_URI"], PHP_URL_PATH );

    $path = trim( $path, '/' );
    $auth = new Auth();
    $task = new Task();

    switch ($path) {
        case 'auth/login':
            $auth->login();
            break;
        case 'auth/signup':
            $auth->signup();
            break;
        case 'task/add':
            $task->add();
            break;  
        case 'task/update':
            $task->update();
            break;  
        case 'task/delete':
            $task->delete();
            break;  
        case 'login': // condition
            require "pages/login.php";
            break;
        case 'signup': // condition
            require "pages/signup.php";
            break;
        case 'logout': // condition
            $auth->logout();
            break;
        default:
            require "pages/home.php";
            break;
    }