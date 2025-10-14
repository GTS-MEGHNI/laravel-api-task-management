<?php

declare(strict_types=1);

return [
    'users' => env('SEED_USERS', 10),
    'projects' => env('SEED_PROJECTS', 3),
    'tasks' => env('SEED_TASKS', 15),
    'comments' => env('SEED_COMMENTS', 25),
    'team_members' => env('SEED_TEAM_MEMBERS', 3),
    'teams' => env('SEED_TEAMS', 2),
];
