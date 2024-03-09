<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    // public function __construct(public UserService $userService){
        
    // }
    public function index($email){
        $user = User::where('email',$email)->with(['experiences'])->firstOrFail();
        // $user = $this->userService->findUserByEmail($email);
        return view('resume',['user'=>$user]);
    }
}
