<?php

namespace App\Providers;

use App\Annexe\containers\ShopSection\ShopCategories\Repositories\CategoryRepository;
use App\Annexe\containers\ShopSection\ShopContacts\Repositories\ContactRepository;
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

            $category = new CategoryRepository();
            $categories = $category->getAllCategories();

            $contactRepository = new ContactRepository();
            $contact = $contactRepository->getContacts();

            View::share(compact('categories', 'contact'));

            Paginator::useBootstrap();
        }
    }
}
