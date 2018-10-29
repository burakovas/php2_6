<?php
include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include ROOT_DIR . 'vendor/autoload.php';  //загрузка твига

//это самодельный автоловадер, эх
//include $_SERVER['DOCUMENT_ROOT'] . "/../services/Autoloader.php";
//spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

$request = new \app\services\Request();
$controllerName = $request->getControllerName() ?: DEFAULT_CONTROLLER;
$actionName = $request->getActionName();

$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($controllerName) . "Controller";

if(class_exists($controllerClass)){
  $controller = new $controllerClass(
    new \app\services\renderers\TemplateRenderer()          //new \app\services\renderers\TwigRenderer()
  );
  $controller->run($actionName);
}
