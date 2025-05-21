<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class HomeController extends Controller
{
    public function index() {
        $topSellingProducts = Product::withCount('orderItems') // Contar la cantidad de veces que un producto se vendió
            ->orderByDesc('order_items_count') // Ordenar por los más vendidos
            ->take(12) // Tomar solo 24 productos - Acá se cambia la cantidad de productos que se cambia en el TOP PRODUCTOS
            ->get();

        return view('welcome', compact('topSellingProducts'));
    }
}
