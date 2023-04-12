<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Models\Restaurant;
use App\Models\Typology;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $typeIds = explode(',', $request->query('types'));
        if ($typeIds) {
            $restaurants =  Restaurant::whereHas('typologies', function (Builder $query) use ($typeIds) {
                $query->whereIn('typology_id', $typeIds);
            }, '=', count($typeIds))->get();
        } else {
            $restaurants = Restaurant::with('typologies')->get();
        }

        foreach ($restaurants as $restaurant) {
            if ($restaurant->logo) $restaurant->logo = url('storage/' . $restaurant->logo);
        }
        return response()->json($restaurants);
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
        $foods = Food::where('is_public', true)->where('restaurant_id', $id)->get();
        $restaurant = Restaurant::where('id', $id)->first();
        if (!$restaurant) return response(null, 404);

        return response()->json(compact('restaurant', 'foods'));
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
}
