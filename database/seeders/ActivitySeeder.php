<?php

namespace Database\Seeders;

use App\Constants;
use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activity::truncate();

        foreach (range(0, 10) as $key) {
            Activity::create([
                'entity_id' => 1,
                'type' => Constants::ACTIVITY_ATTENDANCE,
                'description' => 'login',
            ]);
        }
    }
}
