<?php

namespace Database\Seeders;

use App\Models\AppConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppConfig::create([
            'name'=> 'Angat Pampanga',
            'primary_logo'=> 'primary.png',
            'secondary_logo'=> 'secondary.png'
        ]);
    }
}
