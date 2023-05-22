<?php
  $database = new PDO(
  "mysql:host=devkinsta_db;dbname=todolist",
  "root",
  "LrJHyxBK8VE6Afq8");

    $task_id=$_POST["id"];

    if(empty($task_id)){
        echo "Missing task";
    }else{
        $sql = 'DELETE FROM todolists WHERE id = :id';
        $query = $database->prepare($sql);
        $query->execute([
            'id' => $task_id
        ]);

        header("Location: /");
        exit;
    }
?>