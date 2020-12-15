<?php

namespace Tests\Feature;

use App\Models\UserProfile;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use DatabaseTransactions;

    public function testCreateUser()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt(123456)
        ]);
        $this->assertDatabaseHas('users', ['name' => 'Admin User']);
    }

    public function testCreateUserProfile(){
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt(123456)
        ]);

        $userProfile = UserProfile::create([
            'user_id' => $user->id,
            'address' => 'Nome da rua',
            'zip_code' => '018541'
        ]);
        $this->assertDatabaseHas('users', ['name' => 'Admin User']);
        $this->assertDatabaseHas('user_profiles', [
            'user_id' => $user->id,
            'address' => 'Nome da rua'
        ]);
    }

    public function testGetProfileByUser(){
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt(123456)
        ]);

        UserProfile::create([
            'user_id' => $user->id,
            'address' => 'Nome da rua',
            'zip_code' => '018541'
        ]);

        $profile = UserProfile::find(1);

        $result = $user->profile;

        $this->assertEquals($profile, $result);

    }

    public function testUserService(){

        $data = [
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => 12345,
            'address' => 'minha rua',
            'zip_code' => 992999
        ];

        $userService = new UserService();

        $user = $userService->create($data);
        $expected = User::find(1);

        $this->assertEquals($expected->id, $user->id);

    }

    public function testView(){
        $response = $this->get('/');
        $response->assertStatus(200);
    }

}
