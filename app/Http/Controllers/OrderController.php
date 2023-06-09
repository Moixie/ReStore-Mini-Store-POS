<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Product;
use App\Models\Category;
use App\Models\UnitType;
use App\Models\order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Orders/Index', [
           
            'products' => Product::with(['purchases' => function ($query) {
            $query->where('quantity', '>', 0);
            }])->paginate(3),
            
            'categories'=> Category::all(),
          
        ]);



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
       dd($request->all());
        // Do something with $cartData, like storing it in the database
        
    }

    /**
     * Display the specified resource.
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order $order)
    {
        //
    }
}
