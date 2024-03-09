<?php

use App\Http\Controllers\InformationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\UserExperienceController;
use App\Jobs\SMS;
use App\Mail\Test;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/information', [InformationController::class, 'index'])->name('information');
    Route::post('/information', [InformationController::class, 'store'])->name('information.store');

    Route::get('/experiences', [UserExperienceController::class, 'index'])->name('experiences');
    Route::get('/experiences/create', [UserExperienceController::class, 'create'])->name('experiences.create');
    Route::post('/experiences/create', [UserExperienceController::class, 'store'])->name('experiences.store');
    Route::get('/experiences/{id}/destroy', [UserExperienceController::class, 'destroy'])->name('experiences.destroy');
});

require __DIR__ . '/auth.php';

Route::get('job', function () {
    SMS::dispatch();
    echo 'Sent!';
});

Route::get('email', function () {
    $user = User::orderBy('created_at', 'DESC')->first();
    Mail::to($user)->queue(new Test($user));
    echo "Sent!";
});
Route::get('verification/{token}', function ($token) {
    $id = decrypt($token);
    $user = User::where('id', $id)->whereNull('email_verified_at')->firstOrFail();
    $user->email_verified_at = Carbon::now();
    $user->save();

    echo "You are verified";
})->name('email.verify');

Route::get('/json', function () {
    $users = [
        [
            'pinfo' => [
                'fname' => 'erfan',
                'lname' => 'saleki',
                'age' => 33

            ],
            'education' => [
                'degree' => 'MS',
                'major' => 'IT Engineering',
                'uni' => 'Central Tehran'
            ],
            'experiences' => [
                'position' => 'IT Manager',
                'workplace' => 'MIRTEC Company'
            ]
        ],
        [
            'pinfo' => [
                'fname' => 'emad',
                'lname' => 'saleki',
                'age' => 40

            ],
            'education' => [
                'degree' => 'MA',
                'major' => 'Art',
                'uni' => 'Central Tehran'
            ],
            'experiences' => [
                'position' => 'Graphic Designer',
                'workplace' => 'Websima'
            ]
        ],
        [
            'pinfo' => [
                'fname' => 'Pouriya',
                'lname' => 'MohabbatPour',
                'age' => 29

            ],
            'education' => [
                'degree' => 'MS',
                'major' => 'MBA',
                'uni' => 'Central Tehran'
            ],
            'experiences' => [
                'position' => 'Senior Developer',
                'workplace' => 'Websima'
            ]
        ]
    ];

    return response()->json($users);
});

Route::get('json2', function () {
    $users = User::with(['experiences'])->get();
    return response()->json($users);
});

Route::get('json3', function () {
    $string = file_get_contents('https://jsonplaceholder.typicode.com/todos/1');
    $array = (array) json_decode($string);
    dd($array['title']);
});

Route::get('json4', function () {
    $students = [
        [
            'personal' => [
                'name' => 'erfan',
                'age' => 32
            ],
            'education' => [
                'uni' => 'Central Tehran',
                'major' => 'IT Engineering'
            ]
        ],
        [
            'personal' => [
                'name' => 'emad',
                'age' => 39
            ],
            'education' => [
                'uni' => 'Central Tehran',
                'major' => 'Art'
            ]
        ]
    ];

    return response()->json($students);
});

Route::get('json5',function(){
    $students = User::with(['experiences'])->get();
    // dd($students->toArray());
    return response()->json($students);
});

Route::get('json6',function(){
    $string = file_get_contents('https://jsonplaceholder.typicode.com/todos/1');
    $array = (array)json_decode($string);
    dd($array['title']);

});

Route::get('{email}', [ResumeController::class, 'index'])->name('resume');
