<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(): Response
    {
        $products = Product::paginate(5);
        return Inertia::render('Products/Index', compact('products'));
    }
}
