<?php

namespace App\Settings; // Namespace yang benar adalah App\Settings

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $hero_title = '';
    public string $hero_subtitle = '';
    public string $hero_background = '';

    public static function group(): string
    {
        return 'general';
    }
}