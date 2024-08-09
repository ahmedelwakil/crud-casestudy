<?php

namespace App\Providers;

use App\Http\Controllers\Common\CustomerController;
use App\Http\Controllers\Common\ServiceController;
use App\Http\Controllers\Common\UserController;
use App\Models\Customer;
use App\Models\Service;
use App\Models\User;
use App\Repositories\Common\CustomerRepository;
use App\Repositories\Common\ServiceRepository;
use App\Repositories\Common\UserRepository;
use App\Repositories\RepositoryInterface;
use App\Services\Common\CustomerService;
use App\Services\Common\ServiceService;
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
        $this->app->when(CustomerRepository::class)->needs(Model::class)->give(Customer::class);
        $this->app->when(ServiceRepository::class)->needs(Model::class)->give(Service::class);

        /** Bind Repositories to Services **/
        $this->app->when(UserService::class)->needs(RepositoryInterface::class)->give(UserRepository::class);
        $this->app->when(CustomerService::class)->needs(RepositoryInterface::class)->give(CustomerRepository::class);
        $this->app->when(ServiceService::class)->needs(RepositoryInterface::class)->give(ServiceRepository::class);

        /** Bind Services to Controllers **/
        $this->app->when(UserController::class)->needs(ServiceInterface::class)->give(UserService::class);
        $this->app->when(CustomerController::class)->needs(ServiceInterface::class)->give(CustomerService::class);
        $this->app->when(ServiceController::class)->needs(ServiceInterface::class)->give(ServiceService::class);
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
