<?php
defined('BASE_URL') or die('Direct script access is not allowed');

$routes = [
    // Trang chủ
    '/' => 'article/index',
    
    // Article routes
    'articles' => 'article/index',
    'articles/view/{id}' => 'article/view',
    'articles/create' => 'article/create',
    'articles/edit/{id}' => 'article/edit',
    'articles/delete/{id}' => 'article/delete',
    
    // Auth routes
    'auth/login' => 'auth/login',
    'auth/register' => 'auth/register',
    'auth/logout' => 'auth/logout',
    
    // Member routes
    'members/profile' => 'member/profile',
    'members/update' => 'member/update',
    
    // Category routes
    'categories' => 'category/index',
    'categories/create' => 'category/create',
    'categories/edit/{id}' => 'category/edit',
    'categories/delete/{id}' => 'category/delete',
    'categories/articles/{id}' => 'category/articles'
];

return $routes;