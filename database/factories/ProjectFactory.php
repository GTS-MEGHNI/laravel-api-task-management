<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
final class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(ProjectStatus::cases());

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'team_id' => Team::factory()->create(),
            'owner_id' => User::factory()->create(),
            'slug' => $this->faker->slug(),
            'status' => $this->faker->randomElement(ProjectStatus::cases()),
            'started_at' => $this->faker->dateTimeBetween('-1 year'),
            'ended_at' => $status === ProjectStatus::Archived ?
                $this->faker->dateTimeBetween('now', '+1 year')
                : null,
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(function (Project $project): void {
            $users = $project->team()->first()->users()->pluck('users.id');
            foreach (range(1, 5) as $ignored) {
                Task::factory()->create([
                    'project_id' => $project->id,
                    'assignee_id' => $users->random(),
                ]);
            }
        });
    }
}
