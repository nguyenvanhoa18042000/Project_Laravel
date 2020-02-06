<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Trademark;
use App\Models\ProductImage;
use App\Models\NewsCategory;
use App\Models\Post;
use App\Policies\PostPolicy;
use App\Policies\NewsCategoryPolicy;
use App\Policies\ProductImagePolicy;
use App\Policies\TrademarkPolicy;
use App\Policies\UserPolicy;
use App\Policies\ProductPolicy;
use App\Policies\CategoryPolicy;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
        Category::class => CategoryPolicy::class,
        User::class => UserPolicy::class,
        Trademark::class => TrademarkPolicy::class,
        ProductImage::class => ProductImagePolicy::class,
        NewsCategory::class => NewsCategoryPolicy::class,
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
