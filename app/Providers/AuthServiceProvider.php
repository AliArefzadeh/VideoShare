<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Video;
use App\Policies\CommentPolicy;
use App\Policies\VideoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Video::class => VideoPolicy::class,
        Comment::class => CommentPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* Gate::define('edit-video', function (User $user, Video $video) {
            // return $user->id == $video->user_id;
             //از پایینی وقتی استفاده میکنی که میخوای یه پیغام شخصی سازی شده بنویسی وگرنه همون بالایی اوکیه
             return $user->id == $video->user_id ? Response::allow() : Response::deny('کی بهت گفت بیای اینجا؟؟؟؟');
         }); */
        //متن بالا رو کامنت کردم چون میخوام از policy به جای گیت استفاده کنم
        //برو به صفحه VideoPolicy و متد update
//در بالا همین صفحه تو بخش policies هم باید متد رو رجیستر کنی

    }
}
