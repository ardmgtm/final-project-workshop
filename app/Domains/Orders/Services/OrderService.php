<?php

namespace App\Services;

use App\Domains\Products\Models\Product;
use GuzzleHttp\Client;

class OrderService
{
    public function __construct(private Client $httpClient, private string $apiUrl)
    {
    }

    public function getTotalInventory(Product $product): float
    {
        $content = $this->httpClient
            ->get($this->apiUrl . "inventory/products/$product->id")
            ->getBody()
            ->getContents();

        $data = json_decode($content, true);

        return (float) $data['data']['totalInventory'];
    }
}
