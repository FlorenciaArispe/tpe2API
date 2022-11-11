<?php
require_once './libs/Router.php';
require_once './app/controllers/client-api.controller.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo

$router->addRoute('cliente', 'GET', 'ClientApiController', 'getClients');
$router->addRoute('cliente/:ID', 'GET', 'ClientApiController', 'getClient');
$router->addRoute('cliente/:ID', 'DELETE', 'ClientApiController', 'deleteClient');
$router->addRoute('cliente', 'POST', 'ClientApiController', 'insertClient'); 
$router->addRoute('cliente/:ID', 'PUT', 'ClientApiController', 'updateClient'); 


$router->addRoute('producto', 'GET', 'ProductApiController', 'getProducts');
$router->addRoute('producto/:ID', 'GET', 'ProductApiController', 'getProduct');
$router->addRoute('producto/:ID', 'DELETE', 'ProductApiController', 'deleteProduct');
$router->addRoute('producto', 'POST', 'ProductApiController', 'insertProduct'); 
$router->addRoute('producto/:ID', 'PUT', 'ProductApiController', 'updateProduct'); 

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);