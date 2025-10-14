<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

final class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = config('seeders.tasks') ?? 10;
        Task::factory()->count($count)->create();
    }
}
