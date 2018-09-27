<?php
//命名空间-类自动加在设置
set_include_path(get_include_path().PATH_SEPARATOR);
spl_autoload_extensions('.php');
spl_autoload_register();

require 'vendor/autoload.php';


//路由设置
switch ($_SERVER['REQUEST_METHOD']){
    case 'GET':
        $request = &$_GET;
        break;
    case 'POST':
        $request = &$_POST;
        break;
    default:
        $request = $_REQUEST;
}

$uri = trim($_SERVER['REQUEST_URI'], '/');
list($controller, $methodWParms ) = explode('/', $uri, 2);
list($method, ) = explode('?', $methodWParms, 2);
$controller = "app\Sev\Controller\\$controller";

$obj = new $controller();

//$a[] = function (Request $request){
//    Reflection::class($obj);
//
//};
//foreach ($a as $v){
//    $parme = Reflecton $v;
//    $v($obj);
//}

return call_user_func(array($obj, $method), array('request' => $request));

