<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return '2';
echo 2; die();
    $user = \App\Models\User::findOrFail(13);
    $user->name = 'werty';
    $user->phone =6789;
    $user->save();
    $user->update(['name' => 11111]);
    $user->refresh();

    $user->delete();

    $user1 = \App\Models\User::findOrF(13);
    dd($user->toArray(), $user1->toArray());

    $newUser = \App\Models\User::create([
        'name' => "John Doe",
        'phone' => "01234567891",
    ]);

    dd($newUser);

    return view('welcome');
});

//Route::view('/success', 'success')->name('success');
