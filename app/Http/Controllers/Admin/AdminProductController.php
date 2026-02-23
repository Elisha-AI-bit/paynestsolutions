<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanProduct;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = LoanProduct::all();
        return view('admin.products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'max_amount' => 'required|numeric|min:0',
            'interest_rate' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        LoanProduct::create($request->all());

        return back()->with('success', 'New loan product created successfully.');
    }

    public function update(Request $request, LoanProduct $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'max_amount' => 'required|numeric|min:0',
            'interest_rate' => 'required|numeric|min:0',
        ]);

        $product->update($request->all());

        return back()->with('success', 'Product updated successfully.');
    }
}
