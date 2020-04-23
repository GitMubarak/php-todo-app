<?php
require 'tasks.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Developed To-Do List in PHP using Ajax</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
    <br />
    <br />
    <div class="container">
        <h1 align="center">To-Do Lists</h1>
        <br />
        <div class="panel panel-default">
            <div class="panel-body">
                <span id="message"></span>
                <div class="form-group">
                    <input type="text" name="task_name" id="task_name" class="form-control input-lg" autocomplete="off"
                        placeholder="Enter Task" />
                    <input type="text" name="task_name_edit" id="task_name_edit" data-task_id=""
                        class="form-control input-lg" style="display:none;" />
                </div>
                <div class="list-group">
                    <?php
                    $activeTasks = 0;
                    $tasks = !empty($task->get_tasks()) ? $task->get_tasks() : array();
                    if (count($tasks) > 0) {
                        foreach ($tasks as $row) {
                            $style = '';
                            $status = 'incomplet';
                            if ($row["task_status"] == 1) {
                                $style = 'text-decoration: line-through';
                                $status = 'completed';
                            } else {
                                $activeTasks++;
                            }
                            echo '<a href="#" style="' . $style . '" class="list-group-item ' . $status . '" id="list-group-item-' . $row["task_id"] . '" data-id="' . $row["task_id"] . '" data-task_name="' . $row["task_name"] . '"><span class="complete-task-span" id="complete-task-span-' . $row["task_id"] . '">&nbsp;</span> ' . $row["task_name"] . ' <span class="badge" data-id="' . $row["task_id"] . '">X</span></a>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 footer-item" style="text-align: left; padding-left:30px"><span
                        id="active-tasks-number"><?php echo $activeTasks; ?></span>
                    items left</div>
                <div class="col-md-1 footer-item"><a href="#" id="all-task">All</a></div>
                <div class="col-md-1 footer-item"><a href="#" id="active-task">Active</a></div>
                <div class="col-md-2 footer-item"><a href="#" id="completed-task">Completed</a></div>
                <div class="col-md-4 footer-item" style="text-align: center;"><a href="#" id="clear-completed">Clear
                        completed</a></div>
            </div>
        </div>
    </div>

    <script src="public/js/todo-script.js"></script>
</body>

</html>