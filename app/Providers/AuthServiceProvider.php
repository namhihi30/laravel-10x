<?php

namespace App\Providers;

use App\Models\Group;
use App\Models\Module;
use App\Models\User;
use App\Policies\GroupPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Http;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
//    protected $policies = [
//        User::class => UserPolicy::class,
//        Group::class => GroupPolicy::class
//    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
//        $this->registerPolicies();
//        $moduleList = Module::all();
//        if ($moduleList->count() > 0) {
//            foreach ($moduleList as $module) {
//                Gate::define($module->name, function () use ($module) {
//                    $roleJson = Group::where('user_id', Auth::user()->id)->first()->phanquyen;
//                    if (!empty($roleJson)) {
//                        $roleArr = json_decode($roleJson, true);
//                        $check = isRole($roleArr, $module->name);
//                        return $check;
//                    }
//                    return false;
//                });
//                Gate::define($module->name . '.edit', function () use ($module) {
//                    $roleJson = Group::where('user_id', Auth::user()->id)->first()->phanquyen;
//                    if (!empty($roleJson)) {
//                        $roleArr = json_decode($roleJson, true);
//                        $check = isRole($roleArr, $module->name, 'edit');
//                        return $check;
//                    }
//                    return false;
//                });
//                Gate::define($module->name . '.delete', function () use ($module) {
//                    $roleJson = Group::where('user_id', Auth::user()->id)->first()->phanquyen;
//                    if (!empty($roleJson)) {
//                        $roleArr = json_decode($roleJson, true);
//                        $check = isRole($roleArr, $module->name, 'delete');
//                        return $check;
//                    }
//                    return false;
//                });
//            }
//        }
        Passport::ignoreRoutes();
        Passport::tokensExpireIn(now()->addMinutes(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
