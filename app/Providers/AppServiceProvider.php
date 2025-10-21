<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::prohibitDestructiveCommands(app()->isProduction());
        Model::shouldBeStrict();
        Relation::enforceMorphMap([
            'user' => User::class,
        ]);
    }
}
