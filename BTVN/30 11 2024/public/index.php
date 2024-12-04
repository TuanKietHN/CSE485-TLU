<?php
session_start();

require_once '../app/config/config.php';
require_once '../app/config/database.php';
require_once '../app/core/Router.php';

// Autoload các class
spl_autoload_register(function($className) {
    $paths = [
        CONTROLLER_DIR . '/',
        MODEL_DIR . '/',
        CORE_DIR . '/'
    ];

    foreach($paths as $path) {
        $file = $path . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Khởi tạo routes
$routes = require_once APP_DIR . '/config/routes.php';
Router::init($routes);

// Xử lý routing
try {
    $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
    
    $route = Router::resolve($url);
    
    if ($route) {
        $controllerName = $route['controller'];
        $methodName = $route['action'];
        
        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            if (method_exists($controller, $methodName)) {
                call_user_func_array([$controller, $methodName], $route['params']);
            } else {
                throw new Exception("Phương thức {$methodName} không tồn tại trong {$controllerName}");
            }
        } else {
            throw new Exception("Controller {$controllerName} không tồn tại");
        }
    } else {
        throw new Exception("Không tìm thấy route phù hợp");
    }
} catch (Exception $e) {
    if (DEBUG_MODE) {
        echo "Error: " . $e->getMessage();
    } else {
        require_once VIEW_DIR . '/shared/error404.php';
    }
}