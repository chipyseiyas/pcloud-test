<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$controller = 'Default';

try
{
    $result = json_decode(file_get_contents('php://input'), true);
    if(empty($result))
    {
        $result = $_GET;
    }
    $data = $result;
    if(empty($data))
    {        
        $instance = __DIR__."/controller/{$controller}Controller.php";        
        require_once $instance;
        $controller = ucwords($controller) . 'Controller';
        $controller = new $controller();        
        $controller->index();                  
    }
    else
    {
        $controller = ucwords($data['c']);
        $accion = isset($data['a']) ? $data['a'] : 'Index';
        $instance =  __DIR__."/controller/{$controller}Controller.php";
        require_once $instance;
        $controller = ucwords($controller) . 'Controller';
        $controller = new $controller;
        call_user_func( array( $controller, $accion ) );
    }
}
catch(Exception $e)
{
     var_dump($e->getMessage());
}