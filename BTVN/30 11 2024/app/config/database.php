<?php
// Đảm bảo file này chỉ được gọi thông qua file chính
defined('BASE_URL') or die('Direct script access is not allowed');

// Database Configuration
define('DB_HOST', 'localhost');     // Database host
define('DB_NAME', 'products');      // Database name
define('DB_USER', 'root');          // Database username
define('DB_PASS', '');              // Database password
define('DB_CHARSET', 'utf8mb4');    // Database charset

// PDO Options
define('DB_OPTIONS', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
]);

class Database {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        try {
            $this->connection = new PDO(
                "mysql:host=" . DB_HOST . 
                ";dbname=" . DB_NAME . 
                ";charset=" . DB_CHARSET,
                DB_USER,
                DB_PASS,
                DB_OPTIONS
            );
        } catch (PDOException $e) {
            if (DEBUG_MODE) {
                die("Kết nối thất bại: " . $e->getMessage());
            } else {
                die("Không thể kết nối đến cơ sở dữ liệu. Vui lòng thử lại sau.");
            }
        }
    }
    
    // Ngăn chặn clone object
    private function __clone() {}
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
}

// Function để lấy kết nối database
function getDB() {
    return Database::getInstance()->getConnection();
}

// Khởi tạo kết nối và đặt vào biến toàn cục
$GLOBALS['db'] = getDB();