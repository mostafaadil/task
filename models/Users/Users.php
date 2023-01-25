<?php
require('CrudInterface.php');
require("connection/LocalStorageConnection.php");

class Users implements CrudInterface
{
    private $conn;

    function __construct()
    {
        $this->conn = LocalStorageConnection::getInstance();
    }
    public function all()
    {
        $fp = fopen($this->conn->getConnection()["accounts"], "r");
        $data =   fread($fp, 13234);
        $result = "[" . substr($data, 0, -2) . "]";
        return json_decode($result);
    }
    public function store($data)
    {
        $addUser = $this->conn->getConnection();
        $fp = fopen($addUser["accounts"], "a");
        fwrite($fp, json_encode($data, true) . ",\n");
        return "user created successfully";
    }
    public function findOne($id)
    {
        $data = substr("[" . find(["dir" => $this->conn->getConnection()["accounts"], "search_key" => '"id":' . $id . '']) . "]", 0, -2) . "]";
        return json_decode($data);
    }
    public function destroy($id)
    {
    }
    public function update($data, $id)
    {
        $result = find(["dir" => $this->conn->getConnection()["accounts"], "search_key" => '"id":' . $id . '']);
        $array = substr("[" . $result . "]", 0, -2) . "]";
        $decoded = json_decode($array);
        $decoded[0]->balance = $data["balance"];
        // print_r($decoded);
        $contents = file_get_contents($this->conn->getConnection()["accounts"]);
        $contents = deleteLineInFile($this->conn->getConnection()["accounts"], $result);
        $this->store($decoded[0]);
        return $decoded;
    }
}
