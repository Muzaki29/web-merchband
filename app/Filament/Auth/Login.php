<?php

namespace App\Filament\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

class Login extends BaseLogin
{
    protected string $view = 'filament.pages.auth.login';
    
    protected static string $layout = 'filament-panels::components.layout.base';

    public function getHeading(): string | Htmlable
    {
        return 'Admin Portal';
    }

    public function getSubheading(): string | Htmlable | null
    {
        return 'Welcome back! Please sign in to continue.';
    }
}
