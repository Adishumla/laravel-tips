<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Description;
use App\Models\Resturant;


class DescriptionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'description' => ['required', 'text'],
            'resturant_id' => ['required', 'integer'],
        ]);

        $resturant_id = intval($data['resturant_id']);

        $description = Description::create([
            'description' => $data['description'],
            'resturant_id' => $resturant_id,
        ]);

        Resturant::where('id', $resturant_id)->update(['description_id' => $description->id]);
    }
}
