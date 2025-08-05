<?php

namespace Boy132\FluffyTheme;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Colors\Color;

class FluffyThemePlugin implements Plugin
{
    public function getId(): string
    {
        return 'fluffytheme';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->font('Finger Paint')
            ->colors([
                'danger' => Color::Rose,
                'gray' => Color::hex('#b974c3'), // Fuchsia but desaturated
                'info' => Color::Violet,
                'primary' => Color::Indigo,
                'success' => Color::Teal,
                'warning' => Color::Pink,
            ]);
    }

    public function boot(Panel $panel): void {}

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
