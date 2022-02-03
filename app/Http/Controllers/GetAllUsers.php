<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;


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
        $user = User::All()->leftJoin('followers', 'users.id', '=' , 'followers.follower');

        return response()->json(['users' => $user, 'success' => true], 200);
    }
}
