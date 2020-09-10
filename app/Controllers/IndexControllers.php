<?php
namespace App\Controllers;

use App\DB\DB;
use Exception;

class IndexControllers
{
    public function index()
    {
        $data = new DB();
        $todos = $data->fetchdata();
        return view('app', ['todos'=>$todos]);
    }

    public function delete(){
        $data = file_get_contents('php://input');
        $id = (str_replace('id=','', $data));
        try {
            $task = new DB();
            $task->deletedata($id);
        }catch (Exception $e){
            print_r($e);
        }
        echo 'Deleted';
    }
    public function newTodo(){
        $data = file_get_contents('php://input');
        $item = json_decode($data);
        $taskValue = $item->task;

        try {
            $task = new DB();
            $task->insert($taskValue);
        }catch (Exception $e){
            print_r($e);
        }

        echo 'record successfully added';
    }


    public function editTodo(){
        $datas = file_get_contents('php://input');
        $data = json_decode($datas);
        $id = $data->id;
        if(!isset($data->task)){
            try {
                $update = new DB();
                $update->updatedata($id);
            }catch (Exception $e){
                print_r($e);
            }
        }else{
            $task = $data->task;
            try {
                $update = new DB();
                $update->updatedata($id, $task);
            }catch (Exception $e){
                print_r($e);
            }
        }

        echo 'successfully Updated';
    }


    public function deleteComplete(){
        try{
            $db = new DB();
            $db->deleteComplete();
        }catch (Exception $e){
            print_r($e);
        }
        echo 'successfully Deleted';
    }


    /**
     * @return Exception|string|true
     */
    public function getTodo()
    {
        $datas = file_get_contents('php://input');
        $data = json_decode($datas);
        $todoType = $data->todoType;
        try {
            $db = new DB();
            $todo = $db->filterTodo($todoType);
            $todo = json_encode($todo);
            header('Content-type: application/json');
            return print_r ($todo);
        }catch (Exception $e){
            return $e;
        }
    }
    public function markAllTodo(){
        $db = new DB();
        return $db->markall();
    }

}
