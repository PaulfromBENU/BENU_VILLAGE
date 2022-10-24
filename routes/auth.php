<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// Route::get('/register', [RegisteredUserController::class, 'create'])
//                 ->middleware('guest')
//                 ->name('register');

Route::get('/inscription', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register-fr');

Route::get('/inscription-de', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register-de');

Route::get('/inscription-en', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register-en');

Route::get('/inscription-lu', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register-lu');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest')
                ->name('register');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::get('/login-en', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login-en');

Route::get('/connexion', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login-fr');

Route::get('/login-lu', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login-lu');

Route::get('/login-de', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login-de');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest')
                ->name('login.connect');

// Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
//                 ->middleware('guest')
//                 ->name('password.request');

Route::get('/mot-de-passe-oublie', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request-fr');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request-en');

Route::get('/forgot-password-de', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request-de');

Route::get('/forgot-password-lu', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request-lu');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::get('/reinitialisation-mdp/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset-fr');

Route::get('/reset-password-en/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset-en');

Route::get('/reset-password-de/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset-de');

Route::get('/reset-password-lu/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset-lu');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');
