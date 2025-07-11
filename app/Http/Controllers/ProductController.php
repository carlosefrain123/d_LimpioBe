<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function details($id, $slug)
    {
        // Buscar el producto
        $product = Product::where('id', $id)->where('slug', $slug)->firstOrFail();

        // Obtener los 6 productos más vendidos
        $topSellingProducts = $this->getTopSellingProducts(6);

        return view('products.details', compact('product', 'topSellingProducts'));
    }
    public function getTopSellingProducts($limit = 6)
    {
        return Product::withCount('orderItems') // Contar la cantidad de veces que un producto fue vendido
            ->orderByDesc('order_items_count') // Ordenar por los más vendidos
            ->take($limit) // Tomar solo los productos que se necesiten
            ->get();
    }
}
