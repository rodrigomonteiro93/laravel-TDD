<?php


namespace App\Services;


use App\Models\User;
use App\Models\UserProfile;

class UserService
{

    public function create($data){
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        UserProfile::create([
            'user_id' => $user->id,
            'address' => $data['address'],
            'zip_code' => $data['zip_code']
        ]);

        return $user;

    }

}
