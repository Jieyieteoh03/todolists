<?php

    $db = new DB();

    $task_id=$_POST["task_id"];

    if(empty($task_id)){
        $_SESSION['error'] = "ID unavailable";
        header("Location: /");
        exit;
    }

    $db->delete(
        $sql = 'DELETE FROM todolists WHERE id = :id',
        [
            'id' => $task_id
        ]
    );

    header("Location: /");
    exit;

?>