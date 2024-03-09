<?php
    namespace App\Services;
    use App\Models\User;
    class UserService{
        public function findUserByEmail($email){
            return User::where('email',$email)->with(['experiences'])->firstOrFail();
        }
    }
