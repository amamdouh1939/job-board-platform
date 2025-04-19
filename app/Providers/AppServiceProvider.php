<?php

namespace App\Providers;

use Illuminate\Hashing\HashManager;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Bridge\RefreshTokenRepository;
use Laravel\Passport\Bridge\UserRepository;
use Laravel\Passport\Passport;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Grant\PasswordGrant;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));

        $this->app->singleton('hash', function ($app) {
            return new HashManager($app);
        });

        $this->app->singleton('hash.driver', function ($app) {
            return $app['hash']->driver();
        });

        $this->app->singleton(Hasher::class, function ($app) {
            return $app['hash.driver'];
        });


        app(AuthorizationServer::class)->enableGrantType(
            new PasswordGrant(
                $this->app->make(UserRepository::class),
                $this->app->make(RefreshTokenRepository::class),
            ),
            Passport::tokensExpireIn()
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
