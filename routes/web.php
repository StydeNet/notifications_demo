<?php

use App\DatabaseNotification;
use App\Notifications\Follower;
use App\Notifications\PostCommented;
use App\Post;
use App\User;

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

Route::get('comment/{post}', function (Post $post) {
    // Write comment...

    Notification::send($post->subscribers, new PostCommented($post));
});

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('notifications', function () {
        $notifications = auth()->user()->notifications;

        return view('notifications', compact('notifications'));
    });

    Route::get('notifications/read-all', function () {
        auth()->user()->unreadNotifications->markAsRead();

        return back();
    });

    Route::get('notifications/{notification}', function (DatabaseNotification $notification) {
        
        abort_unless($notification->associatedTo(auth()->user()), 404);

        $notification->markAsRead();

        return redirect($notification->redirect_url);
    });


});

Route::get('profile/{user}', function (User $user) {
    dd($user);
});

Route::get('posts/{post}', function (Post $post) {
    dd($post);
});
