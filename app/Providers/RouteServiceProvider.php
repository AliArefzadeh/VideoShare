<?php

namespace App\Providers;

use App\Models\Video;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    /*public const HOME = '/dashboard';*/
    public const HOME = '/';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });

        Route::bind('likeable_id', function ($value, $route) {
            //در بالا داره میگه هرجا مقدار likeable_id رو برات فرستادن سرچ بزن و بیارش اینجا
            //میتونی به جای likeable_id از likeale_type هم استقاده کنی چون هردو باهم ارسال میشن ولی بعدش باید توی
            //صفجه likeController همه $like_idها رو به $like_type تبدیل کنی وstring نوشته شده پشتش رو هم برداری

//اون $value درواقع نوشته درون ادرس url هست که اگر ویدیو باشه slugش میشه و اگر
            //کامنت باشه idیش میشه

            //هردو مورد likeable_type و likeable_id درون $route قرار دارند
            //این likeable_type مشخص میکنه که لابک ها برای کامنته یا ویدیو

            $model_name = 'App\\Models\\' . ucfirst($route->parameters['likeable_type']);
            $routKey = (new $model_name)->getRouteKeyName();

            /*$likeable=$model_name::where('id',$likeable_id)->first();*/
            return  $model_name::where($routKey, $route->parameters['likeable_id'])->firstOrFail();
            //از firstOrFail به جای first() استفاده کردم که اگر اسم ویدیو اشتباه بود ارور 404 بده

        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
