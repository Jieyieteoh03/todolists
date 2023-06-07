<?php

    $db = new DB();
                
    $completed = $_POST['completed_id'];
    $task_id = $_POST["task_id"];

    if ( $completed == 1) {
        $completed= 0;
    } else if ( $completed == 0){
        $completed= 1;
    }

    if (empty( $task_id )){
        $_SESSION['error'] ="Please insert";
        header("Location: /");
        exit;
    }
        // var_dump( $completed );
        $db->update(

            $sql = 'UPDATE todolists set completed = :completed WHERE id = :id',
            
            [
                'completed' => $completed,
                'id' => $task_id
            ]
        );        
        
        header("Location: /");
        exit;

?>