<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\log;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:8',
            'confirmation_password' => 'required|same:password'
        ]);

        if($validator->fails()) {
            return messageError($validator->messages()->toArray());
        }
        
        $user = $validator->validated();
    
        //masukkan ke database tabel user
        User::create($user);
    
        //isi token JWT
        $payload = [
            'name' => $user['name'],
            'role' => 'user',
            'iat' => now()->timestamp, //waktu dibuat token 
            'exp' => now()->timestamp + 7200 //waktu token kadaluarsa (2 jam setelah token dibuat)
        ];
    
        //generate token dengan algoritma HS256
        $token = JWT::encode($payload,env('JWT_SECRET_KEY'),'HS256');
    
        //kirim response ke pengguna
        return response()->json([
            "data" => [
                'msg' => "berhasil register",
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => 'user',
            ],
            "token" => "Bearer {$token}"
        ],200);
    }

    public function login(Request $request) {

    $validator = Validator::make($request->all(),[
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if($validator->fails()) {
        return messageError($validator->messages()->toArray());
    }

    if(Auth::attempt($validator->validated())) {

        $payload = [
            'name' => Auth::user()->name,
            'role' => Auth::user()->role,
            'iat' => now()->timestamp,
            'exp' => now()->timestamp + 7200
        ];

        $token = JWT::encode($payload,env('JWT_SECRET_KEY'),'HS256');

        return response()->json([
            "data" => [
                'msg' => "berhasil login",
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'role' => Auth::user()->role,
            ],
            "token" => "Bearer {$token}"
        ],200);

    }
        return response()->json("email atau password salah",422);
    }
}
        