<?php 
class Database {
    private $host;
    private $username;
    private $password;
    private $database;
    private $connection;

    public function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->connect();
    }

    private function connect() {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);
    }

    public function query($sql) {
        $result = mysqli_query($this->connection, $sql);
        if (!$result) {
            die("Błąd zapytania: " . mysqli_error($this->connection));
        }
        return $result;
    }

    public function escape($value) {
        return mysqli_real_escape_string($this->connection, $value);
    }
}