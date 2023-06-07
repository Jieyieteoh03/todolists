<?php

    class Task
    {
        public function add()
        {
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
        }

        public function update()
        {
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

        }

        public function delete()
        {
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

        }
    }
?>