<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
//use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\News;
use App\Policies\NewsPolicy;
use App\Comment;
use App\Policies\CommentPolicy;
use App\Notification;
use App\Policies\NotificationPolicy;

use App\User;
use App\Policies\UserPolicy;
use App\Reporteditem;
use App\Policies\ReporteditemPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
      News::class => NewsPolicy::class,
      Comment::class => CommentPolicy::class,
      Notification::class => NotificationPolicy::class,
      User::class => UserPolicy::class,
      Reporteditem::class => ReporteditemPolicy::class
    ];
    // NOTE: see import

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // foreach (get_class_methods(new \App\Policies\AdminPolicy) as $method) {
        //     $gate->define($method, "App\Policies\AdminPolicy@{$method}");
        // }
        $this->registerPolicies();
    }
}
