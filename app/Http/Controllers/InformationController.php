<?php

namespace App\Http\Controllers;

use App\Http\Requests\InformationRequest;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index(){
        return view('information.edit',['user' => auth()->user()]);
    }

    public function store(InformationRequest $request){
        $uploadPath=$request->avatar->store('public/avatars');
        $uploadPath = str_replace('public','',$uploadPath);
        
        $user = auth()->user();
        $user->bio = $request->bio;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->avatar = $uploadPath;
        $user->save();

        return redirect()->route('dashboard');
    }
}
