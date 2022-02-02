<?php

namespace App\Http\Controllers;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function register(RegisterRequest $request){
        
        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
            ];


        $user = User::create($data);
        
        return response()->json($user, 203);
    }

    public function login(LoginRequest $request){

        $credentials = $request->only(['email', 'password']);

        $user = User::where('email', $credentials['email'])->first();
        if($user){
            if(!auth()->attempt($credentials)){
                $message = 'Invalid username or password';
                return response()->json([
                    'success' => false,
                    'message' => $message,
                ], 422);
            }
        
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        $responseMessage = "Login Successful";
        return response()->json([
            'success' => true,
            'token' => $accessToken, 
            'message' => $responseMessage, 
            'user' => auth()->user()]);
        }
        else{
            $responseMessage = "Sorry, this user does not exist";
            return response()->json([
            "success" => false,
            "message" => $responseMessage,
            "error" => $responseMessage
            ], 422);
        }
    }
    public function logout(){
        $user = auth('api')->user()->token();
        $user->revoke();
        $responseMessage = "successfully logged out";
        return response()->json([
        'success' => true,
        'message' => $responseMessage
        ], 200);
    }

    public function viewProfile(){
        $user = auth('api')->user();
        return response()->json(['user' => $user, 'success' => true],200);
    }

}
