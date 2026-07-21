<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscription::truncate();

        $users = User::where('is_admin', false)->get();
        $packages = Package::all();

        if ($users->isEmpty() || $packages->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            $package = $packages->random();

            $numDays = $package->cycle->num_days ?? 30;

            Subscription::create([
                'user_id' => $user->id,
                'package_id' => $package->id,
                'interval' => fake()->numberBetween(1, 3),
                'expires_at' => now()->addDays($numDays * fake()->numberBetween(1, 3)),
                'status' => fake()->randomElement(['active', 'active', 'active', 'inactive', 'suspended']),
            ]);
        }

        Subscription::factory(10)->create();
    }
}
