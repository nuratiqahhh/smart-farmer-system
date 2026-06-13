<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\HarvestRecord;
use Illuminate\Http\Request;

class HarvestRecordController extends Controller
{
    /**
     * Display harvest records
     */
    public function index()
    {
        $records = HarvestRecord::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('harvest-records.index', compact('records'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $products = Product::where(
            'user_id',
            auth()->id()
        )->get();

        return view(
            'harvest-records.create',
            compact('products')
        );
    }

    /**
     * Store harvest record
     */
    public function store(Request $request)
    {
        $request->validate([

            'product_id' => 'required',

            'harvest_quantity' => 'required|numeric|min:1',

            'harvest_date' => 'required|date',

        ]);

        HarvestRecord::create([

            'user_id' => auth()->id(),

            'product_id' => $request->product_id,

            'harvest_quantity' => $request->harvest_quantity,

            'harvest_date' => $request->harvest_date,

            'notes' => $request->notes,

        ]);

        // AUTO UPDATE STOCK

        $product = Product::find(
            $request->product_id
        );

        $product->quantity +=
            $request->harvest_quantity;

        $product->save();

        return redirect()
            ->route('harvest-records.index')
            ->with(
                'success',
                'Harvest record added successfully.'
            );
    }
}