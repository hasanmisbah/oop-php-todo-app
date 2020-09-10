<?php

use App\DB\Connection;
require dirname(__DIR__). '/app/DB/Connection.php';
class table extends Connection {
    public $con;
    public function __construct(){
        $connection = new Connection();
        $this->con = $connection->make();
    }
    public function tableSeed(){
        $query = "SELECT * FROM task";
        $result = mysqli_query($this->con, $query);
        if(empty($result)) {
            $query = "CREATE TABLE tasks ( id int(11) AUTO_INCREMENT, task varchar(255) NOT NULL, completed BOOLEAN,PRIMARY KEY  (id))";
            try {
                $result = mysqli_query($this->con, $query);
                echo 'Table Created';
            }catch (Exception $e){
                echo 'failed to create Table'.$e;
            }
        }
    }
}
$seed = new table();
$seed->tableSeed();
