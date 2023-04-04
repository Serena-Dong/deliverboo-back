<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Food::orderBy('updated_at', 'DESC');
        $foods = $query->get();

        return view('admin.foods.index', compact('foods'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::id();
        $restaurants = Restaurant::where('user_id', $user)->get();

        // SE NON CI SONO RISTORANTI RIMANDA NELL'INDEX
        if((count($restaurants) == 1)){
            return to_route('admin.restaurants.index');
        }

        $food = new Food();
        return view('admin.foods.create',compact('food'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|string|min:5|max:50',
            'price' => 'required|min:1',
            'image' => 'nullable|image|mimes:jpeg,jpg,png',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
            'restaurant_id' => 'nullable|exists:restaurants,id',
        ], [

            'name.required' => 'Il Nome è obbligatorio',
            'name.min' => 'Il Nome deve avere almeno 5 caratteri.',
            'name.max' => 'Il Nome non deve superare i 50 caratteri.',
            'image.image' => 'L\'immagine deve essere file di tipo immagine',
            'image.mimes' => 'Le estensioni accettate sono jpeg, jpg, png',
            'restaurant_id' => 'Ristorante non valido',
        ]);

        $data = $request->all();
        $food = new Food();

        if(Arr::exists($data, 'image')){
            $img_url = Storage::put('foods', $data['image']);
            $data['image'] = $img_url;
        }

        $data['is_public'] = Arr::exists($data, 'is_public');

        $food->fill($data);
        $food->save();
        return to_route('admin.foods.show', $food->id)->with('type', 'danger')->with('msg', "Il Cibo '$food->name' è stato creato con successo.");
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

        $request->validate([

            'name' => 'required|string|min:5|max:50',
            'price' => 'required|min:1',
            'image' => 'nullable|image|mimes:jpeg,jpg,png',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
            'restaurant_id' => 'nullable|exists:restaurants,id',
        ], [

            'name.required' => 'Il Nome è obbligatorio',
            'name.min' => 'Il Nome deve avere almeno 5 caratteri.',
            'name.max' => 'Il Nome non deve superare i 50 caratteri.',
            'image.image' => 'L\'immagine deve essere file di tipo immagine',
            'image.mimes' => 'Le estensioni accettate sono jpeg, jpg, png',
            'restaurant_id' => 'Ristorante non valido',
        ]);

        $data = $request->all();

        if(Arr::exists($data, 'image')){
            if($food->image) Storage::delete($food->image);
            $img_url = Storage::put('foods', $data['image']);
            $data['image'] = $img_url;
        }
        
        $data['is_public'] = Arr::exists($data, 'is_public');

        $food->update($data);
        return view('admin.foods.show', compact('food'))->with('type', 'danger')->with('msg', "Il Cibo '$food->name' è stato modificato con successo.");
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        if($food->image) Storage::delete($food->image);
        $food->delete();
        return to_route('admin.foods.index')->with('type', 'danger')->with('msg', "Il Cibo '$food->name' è stato cancellato con successo.");
    }

    public function toggle(Food $food)
    {
        $food->is_public = !$food->is_public;

        $action = $food->is_public ? 'pubblicato con successo' : 'salvato come bozza';
        $type = $food->is_public ? 'success' : 'info';

        $food->save();

        return redirect()->back()->with('type', $type)->with('msg', "Il post è stato $action.");
    }
}
