<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->orderBy('created_at', 'desc')->get();
        return view('products.index', compact('categories', 'products'));
    }

    public function category($id)
    {
        $categories = Category::all();
        $category = Category::with('products')->findOrFail($id);
        return view('products.category', compact('category', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
