<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function __construct(public UserService $userService){

    }
    public function index($email){
        // $users = User::where('email',$email)->with(['experiences'])->firstOrFail();
        $user = $this->userService->findUserByEmail($email);
        return response()->json($user);
    }
}
