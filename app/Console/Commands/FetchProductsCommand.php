<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\Response;
use App\Models\Product;

class FetchProductsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch products from DummyJSON API';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        for ($page = 1; $page <= 3; $page++) {
            $response = $this->fetchProducts($page);

            if ($response->successful()) {
                $this->processApiResponse($response);
            } else {
                Log::error("Failed to fetch products, HTTP Status: " . $response->status());
            }
        }

        $this->info('Products fetched successfully.');
    }

    /**
     * @param int $page
     * @return Response
     */
    private function fetchProducts(int $page): Response
    {
        $baseUrl = 'https://dummyjson.com/products';

        return Http::get($baseUrl, [
            'limit' => 10,
            'skip' => ($page - 1) * 10
        ]);
    }

    /**
     * @param $response
     * @return void
     */
    private function processApiResponse($response): void
    {
        $products = $response->json()['products'];

        foreach ($products as $productData) {
            $this->processProduct($productData);
        }
    }

    /**
     * @param array $productData
     * @return void
     */
    private function processProduct(array $productData): void
    {
        try {
            $productData['images'] = json_encode($productData['images']);
            Product::updateOrCreate(
                ['id' => $productData['id']],
                $productData
            );
        } catch (Exception $e) {
            Log::error("Failed to process product: " . $e->getMessage());
        }
    }
}
