<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItemCondition;
use App\Models\PrimaryCategory;
use App\Models\SecondaryCategory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(PrimaryCategorySeeder::class);
        $this->call(SecondaryCategorySeeder::class);
        $this->call(ItemConditionSeeder::class);
    }
}
