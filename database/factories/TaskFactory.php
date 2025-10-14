<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Comment;
use App\Models\Task;
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

        return [
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

    public function configure(): self
    {
        return $this->afterCreating(function (Task $task): void {
            $userId = $task->project()->first()->team()->first()->users()->first()->id;
            Comment::factory()->count(5)->create([
                'task_id' => $task->id,
                'user_id' => $userId,
            ]);
        });
    }
}
