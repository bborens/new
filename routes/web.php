<?php




Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/channel/{channel}', 'ChannelController@show');



Route::group(['middleware' => ['auth']], function () {

        Route::get('/channel/{channel}/edit', 'ChannelSettingsController@edit');
        Route::put('/channel/{channel}/edit', 'ChannelSettingsController@update');

});
