<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use SoftRules\Laravel\Controllers\NavigationController;
use SoftRules\Laravel\Controllers\RenderXmlController;

Route::post('softrules/render-xml', RenderXmlController::class)
    ->name('softrules.render-xml');

Route::post('softrules/first-page', [NavigationController::class, 'firstPage'])
    ->name('softrules.first-page');

Route::post('softrules/update-user-interface', [NavigationController::class, 'updateUserInterface'])
    ->name('softrules.update-user-interface');

Route::post('softrules/previous-page', [NavigationController::class, 'previousPage'])
    ->name('softrules.previous-page');

Route::post('softrules/next-page', [NavigationController::class, 'nextPage'])
    ->name('softrules.next-page');
