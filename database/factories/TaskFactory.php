<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
final class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(TaskStatus::cases());
        /** @var Project $project */
        $project = Project::factory()->create();
        /** @var User $assignee */
        $assignee = $project->team->users()->first();

        return [
            'project_id' => $project->id,
            'assignee_id' => $assignee->id,
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(),
            'status' => $status,
            'priority' => $this->faker->randomElement(TaskPriority::cases()),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'completed_at' => $status === TaskStatus::Completed ?
                $this->faker->dateTimeBetween('now', '+1 year')
                :
                null,
        ];
    }
}
