<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Impairment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Event::create([
            "name" => "Mystery Tournament 17",
        ]);

        $impairments = [
            "I have no mouse",
            "I have no controller",
            "I am colorblind",
            "I am hearing impaired",
            "I am prone to motion sickness",
            "I am sensitive to flashing lights",
        ];

        foreach ($impairments as $impairment) {
            Impairment::create([
                "name" => $impairment,
            ]);
        }

        // if (App::environment() == "local") {
        //     $this->call(UserSeeder::class);
        // }
    }
}
