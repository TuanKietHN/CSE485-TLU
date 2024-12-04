<?php
class Router {
    private static $routes = [];
    
    public static function init($routeDefinitions) {
        self::$routes = $routeDefinitions;
    }
    
    public static function resolve($url) {
        if (empty($url)) $url = '/';
        
        foreach (self::$routes as $pattern => $handler) {
            $pattern = str_replace('/', '\/', $pattern);
            $pattern = preg_replace('/\{([a-z]+)\}/', '([^\/]+)', $pattern);
            
            if (preg_match('/^' . $pattern . '$/', $url, $matches)) {
                list($controller, $action) = explode('/', $handler);
                $controller = ucfirst($controller) . 'Controller';
                
                array_shift($matches);
                return [
                    'controller' => $controller,
                    'action' => $action,
                    'params' => $matches
                ];
            }
        }
        return false;
    }
}