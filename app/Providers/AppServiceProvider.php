<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\OtpChannelInterface;
use App\Contracts\Repositories\OtpRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\User;
use App\Repositories\CacheOtpRepository;
use App\Repositories\UserRepository;
use App\Services\Auth\OtpChannels\SmsOtpChannel;
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
        $this->app->bind(OtpRepositoryInterface::class, CacheOtpRepository::class);
        $this->app->bind(OtpChannelInterface::class, SmsOtpChannel::class);
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
