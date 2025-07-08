<?php

namespace Boy132\UserCreatableServers\Providers;

use App\Enums\HeaderActionPosition;
use App\Enums\HeaderWidgetPosition;
use App\Exceptions\Service\Deployment\NoViableAllocationException;
use App\Filament\Admin\Resources\UserResource;
use App\Filament\App\Resources\ServerResource\Pages\ListServers;
use App\Filament\Server\Pages\Console;
use App\Models\Egg;
use Boy132\UserCreatableServers\Filament\Admin\Resources\UserResource\RelationManagers\UserResourceLimitRelationManager;
use Boy132\UserCreatableServers\Filament\App\Widgets\UserResourceLimitsOverview;
use Boy132\UserCreatableServers\Models\UserResourceLimits;
use Exception;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\ServiceProvider;

class UserCreatableServersPluginProvider extends ServiceProvider
{
    public function register(): void
    {
        UserResource::registerCustomRelations(UserResourceLimitRelationManager::class);

        ListServers::registerCustomHeaderWidgets(HeaderWidgetPosition::Before, UserResourceLimitsOverview::class);

        ListServers::registerCustomHeaderActions(HeaderActionPosition::Before,
            Action::make('create_server')
                ->visible(fn () => UserResourceLimits::where('user_id', auth()->user()->id)->exists())
                ->form(function () {
                    /** @var UserResourceLimits $userResourceLimits */
                    $userResourceLimits = UserResourceLimits::where('user_id', auth()->user()->id)->firstOrFail();

                    return [
                        TextInput::make('name')
                            ->label(trans('usercreatableservers::strings.name'))
                            ->required()
                            ->columnSpanFull(),
                        Select::make('egg_id')
                            ->label(trans('usercreatableservers::strings.egg'))
                            ->prefixIcon('tabler-egg')
                            ->options(fn () => Egg::all()->mapWithKeys(fn (Egg $egg) => [$egg->id => $egg->name]))
                            ->required()
                            ->searchable()
                            ->preload(),
                        TextInput::make('memory')
                            ->label(trans('usercreatableservers::strings.memory'))
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue($userResourceLimits->getMemoryLeft())
                            ->suffix(config('panel.use_binary_prefix') ? 'MiB' : 'MB'),
                        TextInput::make('disk')
                            ->label(trans('usercreatableservers::strings.disk'))
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue($userResourceLimits->getDiskLeft())
                            ->suffix(config('panel.use_binary_prefix') ? 'MiB' : 'MB'),
                        TextInput::make('cpu')
                            ->label(trans('usercreatableservers::strings.cpu'))
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue($userResourceLimits->getCpuLeft())
                            ->suffix('%'),
                    ];
                })
                ->action(function (array $data): void {
                    try {
                        /** @var UserResourceLimits $userResourceLimits */
                        $userResourceLimits = UserResourceLimits::where('user_id', auth()->user()->id)->firstOrFail();

                        if ($server = $userResourceLimits->createServer($data['name'], $data['egg_id'], $data['memory'], $data['disk'], $data['cpu'])) {
                            redirect(Console::getUrl(panel: 'server', tenant: $server));
                        }
                    } catch (Exception $exception) {
                        report($exception);

                        if ($exception instanceof NoViableAllocationException) {
                            Notification::make()
                                ->title('Could not create server')
                                ->body('No viable node was found. Please contact the panel admin.')
                                ->danger()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('Could not create server')
                                ->body('Please contact the panel admin.')
                                ->danger()
                                ->send();
                        }
                    }
                })
        );
    }

    public function boot(): void {}
}
