<?php
session_start();
require_once 'config.php';
require_once 'app/Core/Database.php';
require_once 'app/Core/Controller.php';

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home/index';
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

$controllerName = ucfirst($url[0]) . 'Controller';
$methodName = isset($url[1]) ? $url[1] : 'index';

$controllerFile = 'app/Controllers/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName();
    if (method_exists($controller, $methodName)) {
        call_user_func_array([$controller, $methodName], array_slice($url, 2));
    } else {
        echo "404 Method Not Found";
    }
} else {
    echo "404 Controller Not Found";
}
