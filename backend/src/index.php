<?php
require __DIR__ . '/../vendor/autoload.php';
use Src\Action\CreateProductAction;
use Src\Action\DeleteProductAction;
use Src\Action\GetProductAction;
use Src\Action\ListProductsAction;
use Src\Action\UpdateProductAction;

include_once 'Helpers/CorsHelper.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Max-Age: 86400");
    http_response_code(200);
    exit();
}

$router = new AltoRouter();
$router->setBasePath('/api/v1');

$router->map('GET', '/products', function () {
    (new ListProductsAction())();
});

$router->map('GET', '/products/[i:id]', function ($id) {
    (new GetProductAction())($id);
});

$router->map('POST', '/products', function () {
    (new CreateProductAction())();
});

$router->map('PUT', '/products/[i:id]', function ($id) {
    (new UpdateProductAction())($id);
});

$router->map('DELETE', '/products/[i:id]', function ($id) {
    (new DeleteProductAction())($id);
});

$match = $router->match();

if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo json_encode(['error' => 'Endpoint no encontrado']);
}
