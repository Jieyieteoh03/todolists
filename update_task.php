<?php
  $database = new PDO(
  "mysql:host=devkinsta_db;dbname=todolist",
  "root",
  "LrJHyxBK8VE6Afq8");

    $task_done=$_POST["completed"];
    $task_id=$_POST["id"];
    
    if( $task_done == 1){
        $task_done = 0;
    }else if($task_done == 0){
        $task_done = 1;
    }

    if(empty($task_id)){
        echo "Error";
    }else{
        $sql = 'UPDATE todolists set completed = :completed WHERE id = :id';
        $query = $database->prepare($sql);
        $query->execute([
           "completed" => $task_done,
           "id" => $task_id

        ]);

        header("Location: /");
        exit;
    }
?>