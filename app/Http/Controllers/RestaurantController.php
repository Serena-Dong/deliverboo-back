<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Models\Restaurant;
use App\Models\Typology;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::id();
        $restaurants = Restaurant::where('user_id', $user)->get();
        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typologies = Typology::all();
        $user = Auth::id();
        $restaurants = Restaurant::where('user_id', $user)->get();

        if ((count($restaurants) == 1)) {
            return to_route('admin.restaurants.index');
        }
        $restaurant = new Restaurant();

        return view('admin.restaurants.create', compact('restaurant', 'typologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:40',
            'description' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:13',
            'min_order' => 'nullable',
            'shipment_price' => 'nullable',
            // 'typologies' => 'nullable|exists:typologies,id'

        ]);

        $restaurant = new Restaurant();


        $data = $request->all();
        if (Arr::exists($data, 'logo')) {
            // if ($restaurant->logo) Storage::delete($restaurant->logo);
            $img_url = Storage::put('restaurants', $data['logo']);
            $data['logo'] = $img_url;
        }

        $restaurant->fill($data);

        $restaurant->user_id = Auth::id();

        $restaurant->save();
        // Relaziono il post con il / i tag
        if (Arr::exists($data, 'typologies')) $restaurant->typologies()->attach($data['typologies']);

        return to_route('admin.restaurants.show', $restaurant->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {

        if ($restaurant->image) Storage::delete($restaurant->image);
        // if (count($restaurant->typologies)) $restaurant->typologies()->detach();
        $restaurant->delete();
        return to_route('admin.restaurants.index')->with('type', 'danger')->with('msg', "Il ristorante '$restaurant->name' è stato cancellato con successo.");
    }
}
