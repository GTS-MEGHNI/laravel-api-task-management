<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

final class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = config('seeders.teams', 10);
        Team::factory()->count($count)->create();
    }
}
