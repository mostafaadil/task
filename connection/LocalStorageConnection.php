<?php
class LocalStorageConnection
{
    // Hold the class instance.
    private static $instance = null;
    private $conn;
    private $accounts = "storage/accounts.txt";
    private $transactions = "storage/accounts_transactions.txt";

    // The local storage connection is established in the private constructor.
    private function __construct()
    {
        $this->conn["accounts"] = $this->accounts;
        $this->conn["transactions"] = $this->transactions;
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new LocalStorageConnection();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
