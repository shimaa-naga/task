<?php
use \App\Modules\Admin\Controllers\DashboardController;
use \App\Modules\Admin\Controllers\CategoryController;
use \App\Modules\Admin\Controllers\AdminLoginController;
//Route::get('jobs', [\App\Modules\Admin\Models\Category::class, 'index'])->name('jobs.index');
Route::prefix('admin')->group(function () {
    Route::get('/lang/{locale?}', [DashboardController::class, 'changeLang']);
    Route::get('login', [AdminLoginController::class, 'login'])->name('admin.login');
    Route::post('login', [AdminLoginController::class, 'postLogin'])->name('admin.login.post');
    Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('home', [DashboardController::class, 'index'])->name('admin.home');
        Route::resource('category', CategoryController::class,
            ['as' => 'admin']
//            ['names' => [
//            'index' => 'admin.category.index',
//            'store' => 'admin.category.store',
//            'update' => 'admin.category.update',
//            'edit' => 'admin.category.edit',
//            'destroy' => 'admin.category.destroy',
//        ]]
        )->except(['show','destroy']);
    Route::get('category/get_parent', [CategoryController::class, 'get_parent'])->name("admin.category.get_parent");


    });
});
