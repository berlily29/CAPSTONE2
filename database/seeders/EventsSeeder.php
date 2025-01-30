<?php

namespace Database\Seeders;

use App\Models\Announcements;
use App\Models\EventChannels;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Ramsey\Uuid\Generator\RandomLibAdapter;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('EN_US');

        // List of excluded categories
        $excludedCategories = [1, 6, 11, 16, 20, 24];

        // Create 10 sample events
        for ($i = 0; $i < 10; $i++) {
            $event_id = $faker->uuid;

            // Generate a valid event category
            $eventCategory = $this->getRandomCategory($excludedCategories);

            // Insert event data
            DB::table('events')->insert([
                'event_id' => $event_id,
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'event_category' => json_encode([$eventCategory]), // Store as JSON
                'event_organizer' => '2',
                'date' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
                'venue' => $faker->address,
                'target_location' => $faker->randomElement(['Mabalacat', 'Angeles', 'Sanfernando']), // Fixed target location
                'status' => $faker->randomElement(['upcoming', 'ongoing', 'completed']),
                'approved' => $faker->boolean,
                'channel_id' => $event_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create event channel
            EventChannels::create([
                'channel_id' => $event_id,
                'event_id' => $event_id,
            ]);

            // Add 2–3 announcements for the channel
            $numAnnouncements = rand(2, 3);
            for ($j = 0; $j < $numAnnouncements; $j++) {
                Announcements::create([
                    'title' => $faker->sentence,
                    'content' => $faker->paragraph,
                    'channel_id' => $event_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Get a random category, excluding certain values.
     *
     * @param array $excludedCategories
     * @return int
     */
    private function getRandomCategory(array $excludedCategories)
    {
        $category = rand(1, 24);

        // Ensure the category is not in the excluded list
        while (in_array($category, $excludedCategories)) {
            $category = rand(1, 24);
        }

        return $category;
    }
}
