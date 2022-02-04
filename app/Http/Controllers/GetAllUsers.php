<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;


class GetAllUsers extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // $user = User::leftJoin('followers', 'users.id', '=' , 'followers.follower')->get();
        $user = User::with('follower')->get();

        return response()->json(['users' => $user, 'success' => true], 200);
    }
}
