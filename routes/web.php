<?php

use App\Notifications\Follower;
use App\User;
use Illuminate\Notifications\DatabaseNotification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('follow/{follower}/{followed}', function (User $follower, User $followed) {
    
    // Create the follower

    Notification::send($followed, new Follower($follower));
});

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('notifications', function () {
        $notifications = auth()->user()->notifications;

        return view('notifications', compact('notifications'));
    });

    Route::get('notifications/read-all', function () {
        auth()->user()->notifications->markAsRead();

        return back();
    });

    Route::get('notifications/{notification}', function (DatabaseNotification $notification) {
        
        abort_unless($notification->notifiable_id == auth()->id()
            && $notification->notifiable_type =='App\User', 404);

        $notification->markAsRead();

        switch ($notification->type) {
            case 'App\Notifications\Follower':
                return redirect('profile/'.$notification->data['follower_id']);
        }
    });

    Route::get('profile/{user}', function (User $user) {
        dd($user);
    });
});
