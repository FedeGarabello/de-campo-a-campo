<?php
namespace Src\Action;

use Src\Domain\ProductService;
use Src\Responder\ApiResponser;
use Src\Responder\ProductJsonBuilder;   

class ListProductsAction
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
        $products = $this->service->getAll();
        $response = $this->builder->buildList($products);
        $this->responder->successResponse($response, 200);
    }
}
