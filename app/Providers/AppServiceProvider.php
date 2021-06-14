<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->runningInConsole() === false) {

            $categories = Category::orderBy('id')->get();

            $contact = Contact::all()[0];

            View::share(compact('categories', 'contact'));

            Paginator::useBootstrap();
        }
    }
}
