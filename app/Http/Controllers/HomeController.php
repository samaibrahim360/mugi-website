<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)->take(6)->get();

        if ($featuredProducts->count() == 0) {
            $featuredProducts = Product::take(6)->get();
        }

        $categories = Category::with('products')->get();

        $products = Product::latest()->take(8)->get();

        $testimonials = Testimonial::where('approved', true)
            ->latest()
            ->take(6)
            ->get();

        return view('index', compact('featuredProducts', 'categories', 'products', 'testimonials'));
    }
}
