<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Typology;
use Illuminate\Http\Request;

class TypologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typologies = Typology::with('restaurants')->get();
        return response()->json($typologies);
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
    public function show(string $ids)
    {
        $idsArray = str_split($ids);
        $restaurants = [];
        $restIds = [];
        foreach ($idsArray as $id) {
            $restaurant = Typology::where('id', $id)->with('restaurants')->get()->pluck('restaurants')->toArray();
            foreach ($restaurant as $a) {

                foreach ($a as $b) {
                    if (!in_array($b['id'], $restIds)) {
                        $restaurants[] = $b;
                        $restIds[] = $b['id'];
                    }
                }
            }
        }



        return response()->json($restaurants);
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
