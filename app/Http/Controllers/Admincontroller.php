<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Products; 

use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{  
    
    public function register(Request $request) {

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:8',
            'confirmation_password' => 'required|same:password',
            'role' => 'required|in:admin,user',
            'email_validate' => 'required|email'
        ]);

        if($validator->fails()) {
            return messageError($validator->messages()->toArray());
        }

        $user = $validator->validated();

        User::create($user);

        return response()->json([
            "data" => [
                'msg' => "berhasil register",
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
            ]
        ],200);
    }
    public function show_register() {
        $users = user::where('role','user')->get();
        return response()->json([
            "data" => [
                'msg' => "user registrasi",
                'data' => $users
            ]
            ],200);
    }
    public function show_register_by_id($id) {
        $user = user::find($id);
        return response()->json([
            "data" => [
                'msg' => "user id: {$id}",
                'data' => $user
            ]
            ],200);
    }
    public function update_register(Request $request,$id) {
        $user = User::find($id);
        if ($user) {
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'password' => 'min:8',
                'confirmation_password' => 'same:password',
                'role' => 'required|in:admin,user',
            ]);

            if ($validator->fails()) {
                return messageError($validator->messages()->toArray());
            }
            $data = $validator->validated();
            User::where('id',$id)->update($data);
            return response()->json([
                'data' => [
                    "msg" => 'user dengan id: {$id} berhasil diupdate',
                    'name' => $data['name'],
                    'email' => $user['email'],
                    'role' => $data['role'],
                ]
                ],200);
        }
    }
    public function delete_register($id) {
        $user =User::find($id);
        if($user) {
            $user->delete();

            return response()->json([
                "data" => [
                    'msg' => 'user dengan id {$id}, berhasil dihapus'
                ]
                ],200);
        }
        return response()->json([
            "data" => [
                'msg' => 'user dengan id {$id}, tidak ditemukan'
            ]
            ],422);
    }

    public function create_products(Request $request){
        $validator = Validator::make($request->all(),[
            'judul' => 'required|max:255',
            'author' => 'required|max:255',
            // 'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'sinopsis' => 'required',
            'products_type' => 'required|in:fiksi,nyata',
            'products_price' => 'required',
            'status_products' => 'required|in:tersedia,habis',
            'user_email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return messageError($validator->messages()->toArray());
        }

        $thumbnail = $request->file('gambar');
        $filename = now()->timestamp."_".$request->gambar->getClientOriginalName();
        $thumbnail->move('uploads',$filename);

        $productsData = $validator->validated();

        $products = Products::create([
            'judul' => $productsData['judul'],
            'author' => $productsData['author'],
            // 'gambar' => 'uploads/'.$filename,
            'sinopsis' => $productsData['sinopsis'],
            'products_type' => $productsData['products_type'],
            'products_price' => $productsData['products_price'], 
            'status_products' => $productsData['status_products'],
            'user_email' => $productsData['user_email']

        ]);
        return response()->json([
            "data" => [
                "msg" => "products berhasil disimpan",
                "products" => $productsData['judul']
            ]
        ]);
    }
    public function update_products(Request $request,$id) {

        $validator = Validator::make($request->all(),[
                'judul' => 'required|max:255',
                'author' => 'required|max:255',
                'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
                'sinopsis' => 'required',
                'products_type' => 'required|in:fiksi,nyata',
                'products_price' => 'required',
                'status_products' => 'required|in:tersedia,habis',
            ]);

        if($validator->fails()) {
            return messageError($validator->messages()->toArray());
        }

        $thumbnail = $request->file('gambar');
        $filename = now()->timestamp."_".$request->gambar->getClientOriginalName();
        $thumbnail->move('uploads',$filename);

        $productsData = $validator->validated();

       
        Products::where('idproducts',$id)->update([
            'judul' => $productsData['judul'],
            'author' => $productsData['author'],
            'gambar' => 'uploads/'.$filename,
            'sinopsis' => $productsData['sinopsis'],
            'products_type' => $productsData['products_type'],
            'products_price' =>$productsData['products_price'], 
            'status_products' => $productsData['status_products'],
        ]);

        return response()->json([
            "data" => [
                "msg" => "products berhasil diupdate",
                "products" => $productsData['judul']
            ]
        ],200);
    }

    public function delete_products($id) {
        Products::where('idproducts',$id)->delete();

        return response()->json([
            "data" => [
                "msg" => "products berhasil dihapus",
                "products_id" => $id 
            ]
        ],200);
    }

    public function publish_products($id) {

        $products = Products::where('idproducts',$id)->get();

        if($products) {

            Products::where('idproducts',$id)->update(['status_products' => 'tersedia']);

            \App\Models\Log::create([
                'module' => 'publish products',
                'action' => 'publish products dengan id '.$id,
                'useraccess' => 'pocari'
            ]);

            return response()->json([
                "data" => [
                    'msg' => 'products dengan id '.$id.' berhasil di publish'
                ]
                ],200);
        }

        return response()->json([
            "data" => [
                'msg' => 'products dengan id {$id}, tidak ditemukan'
            ]
            ],422);
    }

    public function unpublish_products($id) {

        $products = Products::where('idproducts',$id)->get();

        if($products) {

            Products::where('idproducts',$id)->update(['status_products' => 'habis']);

            \App\Models\Log::create([
                'module' => 'unpublish products',
                'action' => 'unpublish products dengan id '.$id,
                'useraccess' => 'pocari'
            ]);

            return response()->json([
                "data" => [
                    'msg' => 'products dengan id '.$id.' berhasil di unpublish'
                ]
                ],200);
        }

        return response()->json([
            "data" => [
                'msg' => 'products dengan id {$id}, tidak ditemukan'
            ]
            ],422);
    }

    public function detail_products(Request $request) {

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:8',
            'confirmation_password' => 'required|same:password',
            'role' => 'required|in:admin,user',
            'email_validate' => 'required|email'
        ]);

        if($validator->fails()) {
            return messageError($validator->messages()->toArray());
        }

        $user = $validator->validated();

        User::create($user);

        return response()->json([
            "data" => [
                'msg' => "berhasil register",
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
            ]
        ],200);
    }
   

}


    
