<?php
namespace Src\Action;

use Src\Domain\ProductService;
use Src\Responder\ApiResponser;
use Src\Responder\ProductJsonBuilder;  

class GetProductAction
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
        $product = $this->service->getOne($id);
        if ($product) {
            $response = $this->builder->build($product);
            $this->responder->successResponse($response, 200);
        } else {
            $this->responder->errorResponse(['error' => 'Producto no encontrado'], 404);
        }
    }
}
