<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Resturant;

class LikesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer'],
            'resturant_id' => ['required', 'integer'],
        ]);
        /* check if user has liked this post before */
        $user_id = intval($data['user_id']);
        $resturant_id = intval($data['resturant_id']);

        if (Like::where('user_id', $user_id)->where('resturant_id', $resturant_id)->first()) {
            return redirect()->intended('/');
        } else {
            $likes = Like::create([
                'user_id' => $user_id,
                'resturant_id' => $resturant_id,
            ]);
        }

        Resturant::where('id', $resturant_id)->increment('likes');
        return redirect()->intended('/');
    }
}
