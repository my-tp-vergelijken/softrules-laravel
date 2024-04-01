<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use SoftRules\Laravel\Controllers\NavigationController;
use SoftRules\Laravel\Controllers\RenderXmlController;

Route::get('softrules/render-xml', RenderXmlController::class)
    ->name('softrules.render-xml');

Route::get('softrules/update-user-interface', [NavigationController::class, 'updateUserInterface'])
    ->name('softrules.update-user-interface');

Route::get('softrules/previous-page', [NavigationController::class, 'previousPage'])
    ->name('softrules.previous-page');

Route::get('softrules/next-page', [NavigationController::class, 'nextPage'])
    ->name('softrules.next-page');
