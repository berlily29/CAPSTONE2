<?php

namespace Database\Seeders;

use App\Models\AppConfig;
use App\Models\ID;
use App\Models\Users;
use App\Models\UsersLogin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //run other seeders
        $this->call(EventCategorySeeder::class);
        $this->call(EventsSeeder::class);
        $this->call(AppConfigSeeder::class);
        $this->call(UserSeeder::class);



        Users::create([
            'user_id' => 1,  // or any unique ID, if it's auto-incremented, you can omit this
            'fname' => 'John',
            'mname' => 'Doe',
            'lname' => 'Smith',
            'age' => 30,
            'gender' => 'Male',
            'house_no' => '123',
            'street' => 'Main St.',
            'brgy' => 'Brgy. 1',
            'city' => 'Metro City',
            'province' => 'Metro Province',
            'postal_code' => '12345',
            'mobile_no' => '09123456789',
            'profile_picture' => '', // Example image file path or URL
            'profile_points' => 100,  // Default points, if needed
            'email_verified'=> 1,
            'account_status' => 'Approved',
        ]);

        UsersLogin::create([
            'user_id' => "1",
            'email' => 'test@example.com',
            'password'=> Hash::make('superadmin'),
            'role'=> 'Admin'
        ]);


        Users::create([
            'user_id' => "2",  // or any unique ID, if it's auto-incremented, you can omit this
            'fname' => 'Dale',
            'mname' => 'Salo',
            'lname' => 'Bedania',
            'age' => 30,
            'gender' => 'Male',
            'house_no' => '123',
            'street' => 'Main St.',
            'brgy' => 'Brgy. 1',
            'city' => 'Mabalacat',
            'province' => 'Pampanga',
            'postal_code' => '12345',
            'mobile_no' => '09123456789',
            'profile_picture' => '', // Example image file path or URL
            'profile_points' => 100,  // Default points, if needed
            'email_verified'=> 1,

            'account_status' => 'Approved',
        ]);

        ID::create([
            'user_id'=> '2',
            'id_type'=> 'national_id',
            'attachment'=> '2.jpg',
            'status'=> 'Approved'
        ]);

        UsersLogin::create([
            'user_id' => 2,
            'email' => 'userpass@gmail.com',
            'password'=> Hash::make('userpass'),
            'role'=> 'Organizer'
        ]);




    }
}
