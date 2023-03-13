<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resturant;
use App\Models\Description;
use Illuminate\Support\Facades\DB;

class CreateResturantController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $resturant_id = DB::table("resturants")->get("id")->last();
        $description_id = DB::table("descriptions")->get("id")->last();
        $data = $request->validate([
            'category_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'price_id' => ['required', 'integer'],
            'city' => 'required',
            'name' => 'required',
            'description' => '',
        ]);
        // this makes sure that the data is an integer and not a string
        $category_id = intval($data['category_id']);
        $user_id = intval($data['user_id']);
        $price_id = intval($data['price_id']);
        //dd($category_id, $user_id, $price_id);
        $description = Description::create([
            'description' => $data['description'],
        ]);
        $did = $description->id;
        $resturant = Resturant::create([
            'category_id' => $category_id,
            'user_id' => $user_id,
            'price_id' => $price_id,
            'city' => $data['city'],
            'name' => $data['name'],
            'description_id' => $did,
            'likes' => 0,
        ]);


        return redirect()->intended('/dashboard');
    }
}
