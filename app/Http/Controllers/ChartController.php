<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ChartController extends Controller
{
    public function index()
    {
        // Exemple : récupérer le nombre de produits par catégorie
        $products = Product::selectRaw('category_id, COUNT(*) as count')
                            ->groupBy('category_id')
                            ->get();

        $labels = $products->pluck('category_id');
        $data = $products->pluck('count');

        return view('chart', compact('labels', 'data'));
    }

    public function pieChart()
{
    // Jib id w compte mn produits groupé par category
    $products = Product::selectRaw('category_id, COUNT(*) as count')
                        ->groupBy('category_id')
                        ->get();

    // Hna katmap labels mn category_id l smiya dial category (if exists)
    $labels = $products->map(function($product) {
        return $product->category ? $product->category->name : 'Sans catégorie';
    });

    $data = $products->pluck('count');

    return view('piechart', compact('labels', 'data'));

}

}
