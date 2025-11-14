<?php  

require("Router/ProductosController.php");

// CORS: permitir métodos PUT, POST, GET
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Content-Type: application/json; charset=UTF-8");

$method = $_SERVER['REQUEST_METHOD'];

$MyProductoController = new ProductoController();

switch ($method){

    case 'POST':
        $MyProductoController->crearProducto();
    break;

    case 'GET':
        $MyProductoController->listarProductos();
    break;

    case 'PUT':
        $MyProductoController->actualizarProducto();
    break;

    default:
        http_response_code(404);
        echo json_encode(["success" => false, "message" => "404 Not Found"]);
}
