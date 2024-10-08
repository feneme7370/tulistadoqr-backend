<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Page\Category;
use App\Models\Page\Client;
use App\Models\Page\Company;
use App\Models\Page\Level;
use App\Models\Page\Membership;
use App\Models\Page\Order;
use App\Models\Page\Product;
use App\Models\Page\SocialMedia;
use App\Models\Page\Stock;
use App\Models\Page\Suggestion;
use App\Models\Page\Tag;
use App\Models\User;
use App\Policies\Page\CategoryPolicy;
use App\Policies\Page\ClientPolicy;
use App\Policies\Page\CompanyPolicy;
use App\Policies\Page\LevelPolicy;
use App\Policies\Page\MembershipPolicy;
use App\Policies\Page\OrderPolicy;
use App\Policies\Page\PermissionPolicy;
use App\Policies\Page\ProductPolicy;
use App\Policies\Page\RolePolicy;
use App\Policies\Page\SocialMediaPolicy;
use App\Policies\Page\StockPolicy;
use App\Policies\Page\SuggestionPolicy;
use App\Policies\Page\TagPolicy;
use App\Policies\Page\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Level::class => LevelPolicy::class,
        Category::class => CategoryPolicy::class,
        Product::class => ProductPolicy::class,
        Suggestion::class => SuggestionPolicy::class,
        Tag::class => TagPolicy::class,
        Company::class => CompanyPolicy::class,
        SocialMedia::class => SocialMediaPolicy::class,
        Membership::class => MembershipPolicy::class,
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,
        Order::class => OrderPolicy::class,
        Client::class => ClientPolicy::class,
        Stock::class => StockPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
