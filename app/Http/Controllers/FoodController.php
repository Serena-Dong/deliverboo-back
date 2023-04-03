<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.foods.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $food = new Food();
        return view('admin.foods.create',compact('food'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $food = new Food();
        $food->fill($data);
        $post->save();
        return to_route('admin.foods.show', $food->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        return view('admin.foods.show', compact('food'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        return view('admin.foods.edit', compact('food'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Food $food)
    {
        $data = $request->all();
        $food->update($data);
        return view('admin.foods.show', compact('food'));
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        //
    }
}
