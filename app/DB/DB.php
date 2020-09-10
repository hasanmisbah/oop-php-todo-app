<?php

namespace App\DB;

use App\DB\Connection;

class DB
{
    public $con;

    /**
     * DB constructor.
     */
    public function __construct(){
        $connection = new Connection();
        $this->con = $connection->make();
    }

    /**
     * @param $task
     * @return bool|string
     */
    public function insert($task)
    {
        $data = "INSERT INTO tasks(task,completed) values('$task','0')";
        if (mysqli_query($this->con, $data)) {
            return true;
        } else {
            return mysqli_error($this->con);
        }
    }

    /**
     * @param $id
     * @param null $task
     * @return bool|\mysqli_result
     */
    public function updatedata($id, $task = null)
    {
        if ($task) {
            $edit = mysqli_query($this->con, "UPDATE tasks SET task='$task' WHERE id='$id'");
            return $edit;
        } else {
            $check = mysqli_query($this->con, "SELECT task, completed FROM  tasks WHERE id='$id'");
            $data = mysqli_fetch_array($check);
            $data = $data['completed'];
            if($data == 1){
                $edit = mysqli_query($this->con, "UPDATE tasks SET completed=0 WHERE id='$id'");
                return $edit;
            }else{
                $edit = mysqli_query($this->con, "UPDATE tasks SET completed=1 WHERE id='$id'");
                return $edit;
            }

        }
    }

    /**
     * @param $id
     * @return bool|\mysqli_result
     */
    public function deletedata($id)
    {
        $delete = mysqli_query($this->con, "DELETE FROM tasks WHERE id=" . $id);
        return $delete;
    }

    /**
     * @return bool|\mysqli_result
     */
    public function deleteComplete()
    {
        $delete = mysqli_query($this->con, "DELETE FROM tasks WHERE completed=1");
        return $delete;
    }

    /**
     * @param $condition
     * @return array|string
     */
    public function filterTodo($condition)
    {
        if ($condition == 'all') {
            return $this->fetchdata();
        } elseif ($condition == 'active') {
            $result = mysqli_query($this->con, "SELECT * FROM tasks WHERE completed=0 ORDER BY id DESC");
            $data = array();
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            return $data;
        } elseif ($condition == 'complete') {
            $result = mysqli_query($this->con, "SELECT * FROM tasks WHERE completed=1 ORDER BY id DESC");
            $data = array();
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            return $data;
        } else {
            return 'No Todo';
        }
    }

    /**
     * @return array
     */
    public function fetchdata()
    {
        $result = mysqli_query($this->con, "SELECT * FROM tasks ORDER BY id DESC");
        $data = array();
        while ($row = mysqli_fetch_array($result)) {
            $data[] = $row;
        }
        return $data;

    }
    public function markall(){
        $check = mysqli_query($this->con, "SELECT * FROM tasks WHERE completed=0");
        if(mysqli_fetch_array($check)){
            $result = mysqli_query($this->con, "UPDATE tasks SET completed=1");
            return $result;
        }else{
            $result = mysqli_query($this->con, "UPDATE tasks SET completed=0");
            return $result;
        }

    }
}
