<?php
require 'vendor/autoload.php';

use Tasks\DbClass;

class Tasks extends DbClass
{

    public function get_tasks()
    {
        $data = $this->all_tasks("SELECT * FROM tasks");
        if ($data) {
            return $data;
        } else {
            return FALSE;
        }
    }

    public function new_task($task)
    {
        $result = $this->task_query("INSERT INTO tasks (task_name, task_status) VALUES ( '{$task}', 0)");
        if ($result) {
            $task_id = $this->get_last_id();
            echo '<a href="#" class="list-group-item incomplet" id="list-group-item-' . $task_id . '" data-id="' . $task_id . '" data-task_name="' . $task . '"><span class="complete-task-span" id="complete-task-span-' . $task_id . '">&nbsp;</span> ' . $task . ' <span class="badge" data-id="' . $task_id . '">X</span></a>';
        }
    }

    public function complete_task($id)
    {
        $result = $this->task_query("UPDATE tasks SET task_status = 1 WHERE task_id = {$id}");

        if ($result) {
            echo true;
        }

        echo false;
    }

    public function delete_task($id)
    {
        $result = $this->task_query("DELETE FROM tasks where task_id = {$id}");

        if ($result) {
            echo true;
        }

        echo false;
    }

    public function delete_all_task()
    {
        $result = $this->task_query("DELETE FROM tasks where task_status = 1");

        if ($result) {
            echo true;
        }

        echo false;
    }

    public function update_task($id, $task_name)
    {
        $result = $this->task_query("UPDATE tasks SET task_name = '{$task_name}' WHERE task_id = {$id}");

        if ($result) {
            echo true;
        }

        echo false;
    }
}

$task = new Tasks('localhost', 'root', '', 'todo_app');

if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == 'new_task') {
        $task->new_task($_REQUEST['task_name']);
    }

    if ($_REQUEST['action'] == 'complete_task') {
        $task->complete_task($_REQUEST['task_id']);
    }

    if ($_REQUEST['action'] == 'delete_task') {
        $task->delete_task($_REQUEST['task_id']);
    }

    if ($_REQUEST['action'] == 'delete_all_task') {
        $task->delete_all_task();
    }

    if ($_REQUEST['action'] == 'update_task') {
        $task->update_task($_REQUEST['task_id'], $_REQUEST['task_name']);
    }
}