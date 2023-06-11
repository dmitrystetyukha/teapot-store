<?php
require_once sprintf("%s/vendor/autoload.php", __DIR__);
require_once sprintf("%s/app/config.php", __DIR__);

use app\model\TeaPotModel;
use app\usecase\HomeController;
use app\usecase\TeapotUseCase;
use app\utils\Encoder;

$homeView = new HomeController();

$teapotModel   = new TeaPotModel(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$encoder       = new Encoder();
$teapotUseCase = new TeapotUseCase($teapotModel, $encoder);

function getHomeHandler()
{
    require_once sprintf("%s/app/templates/mainpage.php", __DIR__);
}

function getTeaPotListHandler()
{
    global $teapotUseCase;
    echo $teapotUseCase->getTeaPotsList();
}

function addTeapotHandler()
{
    global $teapotUseCase;
    echo $teapotUseCase->addTeaPot();
}

function updateTeapotHandler()
{
    global $teapotUseCase;
    echo $teapotUseCase->update();
}

function deleteTeapotHandler()
{
    global $teapotUseCase;
    echo $teapotUseCase->deleteTeaPot();
}

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'getHomeHandler');
    $r->addRoute('GET', '/teapot-list', 'getTeaPotListHandler');

    $r->addRoute('POST', '/add-teapot', 'addTeapotHandler');
    $r->addRoute('POST', '/update-teapot', 'updateTeapotHandler');

    $r->addRoute('DELETE', '/delete-teapot', 'deleteTeapotHandler');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri        = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        require_once __DIR__ . '/app/templates/404.php';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        require_once __DIR__ . '/app/templates/405.php';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        if (empty($vars)) {
            $handler();
        }
        else {
            $handler($vars);
        }

        break;
}