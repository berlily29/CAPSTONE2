<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Define main categories and subcategories
          $categories = [
            'Environmental' => [
                'Tree Planting',
                'Coastal/Beach Cleanup',
                'Waste Management Campaigns',
                'Urban Gardening Projects',
            ],
            'Community Outreach' => [
                'Feeding Programs',
                'Medical Missions',
                'Community Pantry Operations',
                'Disaster Relief (e.g., Typhoon or Flood Response)',
            ],
            'Education' => [
                'Literacy Campaigns',
                'Tutoring/Teaching Underprivileged Kids',
                'School Supplies Donation Drives',
                'ICT and Digital Literacy Training',
            ],
            'Livelihood' => [
                'Skills Training Workshops (e.g., Sewing, Cooking)',
                'Entrepreneurial Support Programs',
                'Cooperative Building Projects',
            ],
            'Youth Empowerment' => [
                'Sports Development Programs',
                'Leadership Training for Youth',
                'Mentorship and Career Guidance',
            ],
            'Health and Wellness' => [
                'Blood Donation Drives',
                'Mental Health Awareness Programs',
                'Vaccination Campaigns',
            ],
            'Animal Welfare' => [
                'Animal Rescue Operations',
                'Shelter Volunteering',
                'Adoption Events',
            ],
            'Cultural and Heritage Preservation' => [
                'Barangay Fiesta Support',
                'Heritage Site Cleanups',
                'Cultural Dance/Art Campaigns',
            ],
        ];

        foreach ($categories as $categoryName => $subcategories) {
            $categoryId = DB::table('event_categories')->insertGetId([
                'name' => $categoryName,
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($subcategories as $subcategoryName) {
                DB::table('event_categories')->insert([
                    'name' => $subcategoryName,
                    'parent_id' => $categoryId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
