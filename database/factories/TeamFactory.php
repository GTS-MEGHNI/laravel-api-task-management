<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\TeamRole;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Team>
 */
final class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'owner_id' => User::factory()->create(),
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(function (Team $team): void {
            /** @var int $count */
            $count = config('seeders.team_members', 5);
            /** @var Collection<int, User> $users */
            $users = User::factory()->count($count)->create();

            $admin = $users->random();

            // Build pivot data for each user
            $pivotData = $users->mapWithKeys(fn ($user): array => [
                $user->id => [
                    'role' => $user->is($admin)
                        ? TeamRole::Admin->value
                        : TeamRole::Member->value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ])->all();

            $team->users()->attach($pivotData);
        });
    }
}
