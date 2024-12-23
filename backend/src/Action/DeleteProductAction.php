<?php
namespace Src\Action;

use Src\Domain\ProductService;
use Src\Responder\ApiResponser; 

class DeleteProductAction
{
    private $service;
    private $responder;

    public function __construct()
    {
        $this->service = new ProductService();
        $this->responder = new ApiResponser();
    }

    public function __invoke($id)
    {
        $deleted = $this->service->delete($id);

        if ($deleted) {
            $this->responder->successResponse(['message' => 'Producto eliminado'], 200);
        } else {
            $this->responder->errorResponse(['error' => 'Producto no encontrado'], 404);
        }
    }
}
