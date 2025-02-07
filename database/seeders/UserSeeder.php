<?php

namespace Database\Seeders;

use App\Models\ID;
use Illuminate\Database\Seeder;
use App\Models\Users;
use App\Models\UsersLogin;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 100; $i <= 150; $i++) {
            // Create user
            $user = Users::create([
                'user_id' => $i,  // You can omit this if it's auto-incremented
                'fname' => $faker->firstName,
                'mname' => $faker->lastName,
                'lname' => $faker->lastName,
                'age' => $faker->numberBetween(18, 60),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'house_no' => $faker->buildingNumber,
                'street' => $faker->streetName,
                'brgy' => $faker->word,
                'city' => $faker->city,
                'province' => $faker->state,
                'postal_code' => $faker->postcode,
                'mobile_no' => $faker->phoneNumber,
                'profile_picture' => '', // Can be customized to include a path to a random profile image
                'profile_points' => $faker->numberBetween(50, 200),
                'email_verified' => 1,
                'account_status' => $faker->randomElement(['Approved', 'Pending', 'Suspended']),
            ]);

            // Create user login
            UsersLogin::create([
                'user_id' => $user->user_id,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'), // Default password or generate random
                'role' => $faker->randomElement(['User', 'Admin']),
            ]);

            ID::create([
                'user_id'=> $user->user_id,
                'id_type'=> 'national_id',
                'attachment'=> '2.jpg',
                'status'=> 'Approved'
            ]);


        }
    }
}
