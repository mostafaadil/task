<?php
require('storage/finder.php');
class UsersTransactions implements CrudInterface
{
    private $conn;

    function __construct()
    {
        $this->conn = LocalStorageConnection::getInstance();
    }
    public function all()
    {
        $fp = fopen($this->conn->getConnection()["transactions"], "r");
        $data =   fread($fp, 13234);
        $result = "[" . substr($data, 0, -2) . "]";
        return json_decode($result);
    }
    public function store($data)
    {
        $fp = fopen($this->conn->getConnection()["transactions"], "a");
        fwrite($fp, json_encode($data, true) . ",\n");
        return "transaction created successfully";
    }
    public function findOne($id)
    {
        $data = substr("[" . find(["dir" => $this->conn->getConnection()["transactions"], "search_key" => '"id":' . $id . '']) . "]", 0, -2) . "]";
        return json_decode($data);
    }

   
    public function destroy($id)
    {
    }
    public function update($data, $id)
    {
    }
    public function getTransactionsByAccount($id)
    {
        $data = substr("[" . find(["dir" => $this->conn->getConnection()["transactions"], "search_key" => '"from_user_id":' . $id . '']) . "]", 0, -2) . "]";
        return json_decode($data);
    }
}
