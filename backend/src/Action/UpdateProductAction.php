<?php
namespace Src\Action;

use Src\Domain\ProductService;
use Src\Responder\ApiResponser;
use Src\Responder\ProductJsonBuilder;  

class UpdateProductAction
{
    private $service;
    private $responder;
    private $builder;

    public function __construct()
    {
        $this->service = new ProductService();
        $this->responder = new ApiResponser();
        $this->builder = new ProductJsonBuilder();
    }

    public function __invoke($id)
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['name']) || !isset($input['description']) || !isset($input['price'])) {
            return $this->responder->errorResponse(['error' => 'Datos incompletos'], 400);
        }

        $updatedProduct = $this->service->update($id, $input);
        if ($updatedProduct) {
            $response = $this->builder->build($updatedProduct);
            $this->responder->successResponse($response, 200);
        } else {
            $this->responder->errorResponse(['error' => 'Producto no encontrado'], 404);
        }
    }
}
