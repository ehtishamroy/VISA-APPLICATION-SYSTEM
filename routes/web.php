<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Candidates
    Route::delete('candidates/destroy', 'CandidateController@massDestroy')->name('candidates.massDestroy');
    Route::resource('candidates', 'CandidateController');
    Route::get('candidates/{candidate}', 'CandidateController@show')->name('candidates.show');

     // CV Loader-Specific Routes
     Route::put('candidates/{candidate}/update-cv-status', 'CandidateController@updateCvStatus')
     ->name('candidates.updateCvStatus');
 Route::put('candidates/{candidate}/update-visa-status', 'CandidateController@updateVisaStatus')
     ->name('candidates.updateVisaStatus');
 Route::post('candidates/{candidate}/upload-cv', 'CandidateController@uploadCv')
     ->name('candidates.uploadCv');

    // Instructor Routes (Update Test Status)
    Route::put('candidates/{candidate}/update-test-status', 'CandidateController@updateTestStatus')->name('candidates.updateTestStatus');
    // Accountant Routes (Update Payment Status)
    Route::post('candidates/{candidate}/update-payment-status', 'CandidateController@updatePaymentStatus')->name('candidates.updatePaymentStatus');

    // Dialer-Specific Routes
    Route::post('candidates/{candidate}/add-remark', 'CandidateController@addRemark')
    ->name('candidates.addRemark');    // CV Loader Routes (Update CV and Visa Status)
    Route::post('candidates/{candidate}/update-cv-visa-status', 'CandidateController@updateCvVisaStatus')->name('candidates.updateCvVisaStatus');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});