<?php
namespace Src\Action;

use Src\Domain\ProductService;
use Src\Responder\ApiResponser;
use Src\Responder\ProductJsonBuilder;  

class CreateProductAction
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

    public function __invoke()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['name']) || !isset($input['description']) || !isset($input['price'])) {
            return $this->responder->errorResponse(['error' => 'Datos incompletos'], 400);
        }

        $newProduct = $this->service->create($input);
        $response = $this->builder->build($newProduct);
        $this->responder->successResponse($response, 201);
    }
}
