<?php

namespace Src\Responder;

use Src\Model\Product;

class ProductJsonBuilder
{
    private float $usdRate;

    public function __construct()
    {
        $this->usdRate = getenv('USD_VALUE');
    }

    public function build(Product $product): array
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => (float) $product->price,
            'usd_price' => $this->convertToUSD($product->price),
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at,
        ];
    }

    private function convertToUSD(float $priceInARS): float
    {
        return round($priceInARS / $this->usdRate, 2);
    }

    public function buildList(array $products): array
    {
        return array_map(function ($product) {
            return $this->build($product);
        }, $products);
    }
}
