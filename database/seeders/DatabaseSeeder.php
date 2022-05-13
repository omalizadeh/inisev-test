<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserWebsite;
use App\Models\Website;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(80)->create();
        Website::factory()->count(3)->create();

        $randomUsers = User::inRandomOrder()->take(50)->get();

        $firstWebsite = Website::find(1);
        $secondWebsite = Website::find(2);

        foreach ($randomUsers as $user) {
            UserWebsite::create([
                'website_id' => ($user->id % 2 == 0) ? $firstWebsite->id : $secondWebsite->id,
                'user_id' => $user->id,
            ]);
        }
    }
}
