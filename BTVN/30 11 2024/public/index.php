<?php
session_start();

require_once '../app/config/config.php';
require_once '../app/config/database.php';

// Autoload các class
spl_autoload_register(function($className) {
    $paths = [
        '../app/controllers/',
        '../app/models/',
        '../app/core/'
    ];

    foreach($paths as $path) {
        $file = $path . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
// Default controller và method
$defaultController = 'Article';
$defaultMethod = 'index';

// Simple routing
$url = isset($_GET['url']) ? explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)) : [$defaultController];

$controllerName = ucfirst($url[0]) . 'Controller';
$methodName = isset($url[1]) ? $url[1] :  $defaultMethod;

if (class_exists($controllerName)) {
    $controller = new $controllerName();
    if (method_exists($controller, $methodName)) {
        $controller->$methodName();
    } else {
        // Handle 404
        require_once '../app/views/shared/error.php';
    }
} else {
    // Handle 404
    require_once '../app/views/shared/error.php';
}

// Xử lý routing
try {
    $url = isset($_GET['url']) ? explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)) : [$defaultController];
    
    $controllerName = ucfirst($url[0]) . 'Controller';
    $methodName = isset($url[1]) ? $url[1] : 'index';
    
    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        if (method_exists($controller, $methodName)) {
            $params = array_slice($url, 2);
            call_user_func_array([$controller, $methodName], $params);
        } else {
            throw new Exception("Phương thức không tồn tại");
        }
    } else {
        throw new Exception("Controller không tồn tại");
    }
} catch (Exception $e) {
    if (DEBUG_MODE) {
        echo "Error: " . $e->getMessage();
    } else {
        require_once '../app/views/shared/error404.php';
    }
}