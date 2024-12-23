<?php
namespace Src\Domain;

class ProductService
{
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function getAll()
    {
        $products = $this->productRepository->all();
        return $products;
    }

    public function getOne($id)
    {
        $product = $this->productRepository->find($id);
        return $product;
    }

    public function create($data)
    {
        $newProduct = $this->productRepository->create($data);
        return $newProduct;
    }

    public function update($id, $data)
    {
        $product = $this->productRepository->update($id, $data);
        return $product;
    }

    public function delete($id)
    {
        $product = $this->getOne($id);
        if (!$product) {
            return false;
        }
        return $this->productRepository->delete($id);
    }
}
