<?php
class Database {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $conn;

    public function __construct() {
        $this->host = $_SERVER['DB_HOST'] ?? 'localhost';
        $this->dbname = $_SERVER['DB_NAME'] ?? 'tlunews';
        $this->username = $_SERVER['DB_USER'] ?? 'root';
        $this->password = $_SERVER['DB_PASS'] ?? '';

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->username,
                $this->password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            die("Lỗi kết nối database: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}