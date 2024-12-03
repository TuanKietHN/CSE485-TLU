<?php
session_start();

require_once 'config/config.php';
require_once 'config/Database.php';

// Include các Model
require_once 'models/News.php';
require_once 'models/Category.php';
require_once 'models/User.php';

// Kiểm tra biến url
$url = isset($_GET['url']) ? $_GET['url'] : 'home';
$url = rtrim($url, '/');
$url = explode('/', $url);

// Xác định controller
$controller = isset($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
$action = isset($url[1]) ? $url[1] : 'index';
$param = isset($url[2]) ? $url[2] : null;

// Debug
echo "Controller: " . $controller . "<br>";
echo "Action: " . $action . "<br>";

// Kiểm tra file controller tồn tại
$controllerFile = "controllers/$controller.php";
if (!file_exists($controllerFile)) {
    die("Controller file not found: " . $controllerFile);
}

require_once $controllerFile;

// Kiểm tra class controller tồn tại
if (!class_exists($controller)) {
    die("Controller class not found: " . $controller);
}

$controllerInstance = new $controller();

// Kiểm tra method tồn tại
if (!method_exists($controllerInstance, $action)) {
    die("Action not found: " . $action);
}

// Gọi method
$controllerInstance->$action($param);
