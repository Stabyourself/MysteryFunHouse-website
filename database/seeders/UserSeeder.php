<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Completion;
use App\Models\Entry;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use \GuzzleHttp;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        // $maurice = User::factory()->create([
        //     "id" => "84300263346704384",
        //     "username" => "Maurice",
        //     "avatar" => "https://cdn.discordapp.com/avatars/84300263346704384/e932a3333e0424d2d7594427179e13e9"
        // ]);

        // $maurice->assignRole("Admin");

        $client = new GuzzleHttp\Client();

        User::factory()
            ->count(50)
            ->create()
            ->each(function (User $user) use ($client) {
                $avatarUrl = "https://picsum.photos/100?{$user->id}";

                // gotta cache avatars
                $path = Storage::path('public/avatars/' . $user->id);
                $client->request('GET', $avatarUrl, [
                    'sink' => $path,
                ]);
            });
    }
}
