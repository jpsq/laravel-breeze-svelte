<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return Inertia::render('Items/Index', ['items' => $items]);
    }
    

    public function create()
    {
        return Inertia::render('Items/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
    
        $item = Item::create($request->all());
    
        return redirect()->route('items.index')->with('success', 'Item created successfully!');
    }

    public function edit(Item $item)
    {
        return Inertia::render('Items/Edit', ['item' => $item]);
    }
    
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
    
        $item->update($request->all());
    
        return redirect()->route('items.index')->with('success', 'Item updated successfully!');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index');
    }
}