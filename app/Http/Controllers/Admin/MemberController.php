<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function login(Request $request)
    {
        $credentionals = $request->only("email","password");
        if(auth()->attempt($credentionals)) 
        {
            return redirect()->route("admin.index");
        }
        return redirect()->back()->withErrors(
            ['login'=>'Giriş bilgileri hatalı']
        );
    }
    public function logout(){
        auth()->logout();
        return redirect()->route("login");
    }

    public function register(Request $request)
    {
        $data = $request->only("name","surname","email","password","repassword");
        //dd($data);
        if($data["password"]!= $data["repassword"])
        {
            $message =['message'=> 'Parolalar Eşleşmedi.'];
            return redirect()->back()->withInput()->withErrors($message);
        }
        else
        {
            User::create(
                [
                    "name"=> $data["name"]. ' ' . $data['surname'],
                    "email"=> $data["email"],
                    "password"=> bcrypt($data["password"]),
    
                ]);
           
             return redirect()->route("login");
        }
       
    }
}
