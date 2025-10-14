<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ProjectStatus;
use App\Models\Project;
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
        /** @var Team $team */
        $team = Team::factory()->create();
        /** @var User $owner */
        $owner = $team->users()->first();

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'team_id' => $team->id,
            'owner_id' => $owner->id,
            'slug' => $this->faker->slug(),
            'status' => $this->faker->randomElement(ProjectStatus::cases()),
            'started_at' => $this->faker->dateTimeBetween('-1 year'),
            'ended_at' => $status === ProjectStatus::Archived ?
                $this->faker->dateTimeBetween('now', '+1 year')
                : null,
        ];
    }
}
