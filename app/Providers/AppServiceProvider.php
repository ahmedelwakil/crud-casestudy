<?php

namespace App\Providers;

use App\Http\Controllers\Common\UserController;
use App\Models\User;
use App\Repositories\Common\UserRepository;
use App\Repositories\RepositoryInterface;
use App\Services\Common\UserService;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /** Bind Models to Repositories **/
        $this->app->when(UserRepository::class)->needs(Model::class)->give(User::class);

        /** Bind Repositories to Services **/
        $this->app->when(UserService::class)->needs(RepositoryInterface::class)->give(UserRepository::class);

        /** Bind Services to Controllers **/
        $this->app->when(UserController::class)->needs(ServiceInterface::class)->give(UserService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
