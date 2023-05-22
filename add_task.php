<?php
  $database = new PDO(
  "mysql:host=devkinsta_db;dbname=todolist",
  "root",
  "LrJHyxBK8VE6Afq8");

    $tasks=$_POST['tasks'];

    if(empty($tasks)){
        echo "Error 404";
    }else{
        $sql = 'INSERT INTO todolists (`task`, `completed`) VALUES (:task,:completed)';
        $query = $database->prepare($sql);
        $query->execute([
            'task'=> $tasks,
            'completed' => 0
        ]);

        header("Location: /");
        exit;
    }
?>