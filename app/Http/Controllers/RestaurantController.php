<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;



use App\Models\Restaurant;
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
        $restaurant = new Restaurant();
        return view('admin.restaurants.create', compact('restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:40',
            'description' => 'required|string',
            'logo' => 'nullable|string|mimes:jpeg,jpg,png',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:10|min:10',
            'min_order' => 'nullable',
            'shipment_price' => 'nullable'

            
        ]);

        $restaurant = new Restaurant();


        $data = $request->all();
        if (Arr::exists($data, 'logo')) {
            if ($restaurant->logo) Storage::delete($restaurant->logo);
            $extension = $data['logo']->extension();
            $img_url = Storage::putFileAs('restaurants', $data['logo']);
            $data['logo'] = $img_url;
        }
        
        $restaurant->fill($data);

        $restaurant->user_id = Auth::id();

        $restaurant->save();

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

        // if ($restaurant->image) Storage::delete($restaurant->image);
        // if (count($restaurant->typologies)) $restaurant->typologies()->detach();
        $restaurant->delete();
        return to_route('admin.restaurants.index');
    }
}
