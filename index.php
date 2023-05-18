<?php
  session_start();

  $tasks = [];

  $database = new PDO(
  "mysql:host=devkinsta_db;dbname=todolist",
  "root",
  "LrJHyxBK8VE6Afq8");

  $sql = "SELECT * FROM todolists";
  $query = $database->prepare($sql);
  $query->execute();
  $tasks = $query->fetchAll();

  
?>

<!DOCTYPE html>
<html>
  <head>
    <title>TODO App</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #f1f1f1;
      }
    </style>
  </head>
  <body>
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <div class="d-flex gap-3">
            <?php if (isset($_SESSION["user"])){ ?>
              <a href="logout.php">Logout</a>
            <?php }else{?>
            <a href="sign_up.php">Sign up</a>
            <a href="login.php">Login</a>
            <?php }?>
        </div>
        <?php if (isset ($_SESSION["user"])){?> 
          <ul class="list-group">
              <?php
              foreach ($tasks as $task) {?>
            <li
            class="list-group-item d-flex justify-content-between align-items-center"
            >
            <div>
              <form method = "POST" action="update_task.php">
                <input 
                      type="hidden"
                      name="completed"
                      value="<?=
                        $task["completed"]
                        ?>"
                    />
                    <input 
                    type="hidden"
                    name="id"
                    value="<?=
                        $task["id"];
                        ?>"
                    />
                    <?php
                  if($task["completed"] == 1){
                    echo 
                    "<button class='btn btn-sm btn-success'>
                    <i class='bi bi-check-square'></i>
                    </button>
                    ";
                  }else{
                    echo  
                    "<button class='btn btn-sm btn-light'>
                    <i class='bi bi-square'></i>
                    </button>";
                  }
                  ?> 
                
                <?php
                  if($task["completed"] == 1){
                    echo 
                    "<span class='ms-2 text-decoration-line-through'>" .
                    $task['task'] .
                    "</span>";
                  }else{
                    echo
                    "<span class='ms-2'>" .
                    $task['task'] .
                    "</span>";
                  }
                  ?>
                </form>
              </div>
              <div> 
                <form method = "POST" action="delete_task.php">
                  <input 
                  type="hidden"
                  name="id"
                  value="<?=
                        $task["id"];
                        ?>"
                    />
                    <button class="btn btn-sm btn-danger">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </li>
            <?php } ?>
          </ul>
        <?php } ?>
        <div class="mt-4">
          <form method="POST" action="add_task.php" class="d-flex justify-content-between align-items-center">
            <input
              type="text"
              class="form-control"
              placeholder="Add new item..."
              name="tasks"
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
