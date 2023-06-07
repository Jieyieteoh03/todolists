<?php

    $db = new DB();

    $task_name = $_POST['task_name'];

    if (empty($task_name)){
        $_SESSION['error'] = "Please insert";
        header("Location: /");
        exit;
    }
        
    $sql = 'INSERT INTO todolists (`task`, `completed`) VALUES (:task,:completed)';
        
    $db->insert($sql,[
        'task' => $task_name,
        'completed' => 0
    ]);

    header("Location: /");
    exit;

?>