<?php
use \App\Http\Middleware\CheckVerifyEmail;
use Illuminate\Support\Facades\Log;
use \Illuminate\Support\Facades\Response;
use \Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use  \Illuminate\Support\Facades\Storage;
use  \Illuminate\Support\Facades\Gate;
use \Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;
use App\Mail\VerifyEmail;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\CategoryVideoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\indexController::class, 'index',])->name('index');

Route::get('/videos/create', [videoController::class, 'create',])->middleware('emailVerify')->name('videos.create');


Route::post('/videos', [videoController::class, 'store'])->name('videos.store');
Route::get('/videos/{video}', [videoController::class, 'show'])->name('videos.show');

Route::get('/videos/{video}/edit', [videoController::class, 'edit'])->name('videos.edit');
Route::post('/videos/{video}', [videoController::class, 'update'])->name('videos.update');

Route::get('categories/{category:slug}/videos', [CategoryVideoController::class, 'index'])->name('categories.videos.index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



Route::get('/email', function () {
    $user = User::first();
    return (new VerifyEmail($user));
});


Route::get('/verify/{id}', function () {
    var_dump(\request()->hasValidSignature());
})->name('verify');

Route::get('/generate', function () {
    return Url::temporarySignedRoute('verify', now()->addSecond(120), ['id' => 2]);
});

Route::get('/jobs', function () {
    \App\Jobs\OTP::dispatch();

});

Route::get('/event', function () {
    $video = Video::first();
    \App\Events\VideoCreated::dispatch($video);
});

Route::get('query', function () {
    $videos = Video::all();
    $videos->load('user');

    foreach ($videos as $video) {
        dump($video->user->name);
    }
});

Route::post('/videos/{video}/comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
Route::get('/{likeable_type}/{likeable_id}/like', [\App\Http\Controllers\LikeController::class, 'store'])->name('likes.store');
Route::get('/{likeable_type}/{likeable_id}/dislike', [\App\Http\Controllers\DislikeController::class, 'store'])->name('dislikes.store');



Route::get('file', function () {
    return response()->file(storage_path('app/contracts/first.jpg'));
});

Route::get('duration', function () {
    $path = 'videosForU/Dhgtz1H3g3irPbxsKv6xF8g4Frqfb4SpNmb85DDK.mp4';
    $services=new \App\Services\FFMpegAdaptor($path);
    dd($services->getDuration());
});

Route::get('frame', function () {
    $jpg = new \App\Services\FFMpegAdaptor('videosForU/Dhgtz1H3g3irPbxsKv6xF8g4Frqfb4SpNmb85DDK.mp4');
    $jpg->getFrame();
    dd($jpg);
});


Route::get('test-gate', function () {
    $result = Gate::allows('test');
    if (!$result) {
        abort(403);
    }
    dd('hi');
});

Route::get('cache', function () {
   $value= Cache::remember('video_count', 10, function () {
        sleep(3);
        return Video::all()->count();
    });
    dump($value);
});


Route::get('log', function () {
    Log::info('This is a test');
});



Route::get('/notify', function () {
    $user = User::first();
    $video = Video::first();
        $user->notify(new \App\Notifications\VideoProcessed($video));
});


require __DIR__ . '/auth.php';











/*


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    /*$response=Auth::attempt([
        'email'=>"rajaei.simin@example.com",
        'password' => "password",
    ]);
    dd($response);*/


/* $user = User::find(1);
 Auth::login($user);
 $response = Auth::check();
 dd($response);*/

/* Auth::onceBasic();});*/


/*Route::get('/upload', function () {
    return view('videos.create');
});*/
//در واقع رفته در پوشه resources بعد پوشه views بعد videos بعد صفحه create
//این بالایی رو بذار توی کامنت بمونه


