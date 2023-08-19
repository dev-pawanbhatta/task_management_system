<?php
class Database
{
    private $host = 'localhost'; // Host name
    private $username = 'root'; // Mysql username
    private $password = ''; // Mysql password
    private $database = '';
    private $conn;

    public function __construct(string $database)
    {
        $this->database = $database;
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            $this->returnValue();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function returnValue()
    {
        return $this->conn;
    }
}


$newDB = new Database('task_management_system');
$database = $newDB->returnValue();
