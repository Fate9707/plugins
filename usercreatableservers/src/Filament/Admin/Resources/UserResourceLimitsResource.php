<?php

namespace Boy132\UserCreatableServers\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages\EditUser;
use App\Models\User;
use Boy132\UserCreatableServers\Filament\Admin\Resources\UserResourceLimitsResource\Pages\ManageUserResourceLimits;
use Boy132\UserCreatableServers\Models\UserResourceLimits;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserResourceLimitsResource extends Resource
{
    protected static ?string $model = UserResourceLimits::class;

    protected static ?string $navigationIcon = 'tabler-cube-plus';

    public static function getNavigationLabel(): string
    {
        return trans_choice('usercreatableservers::strings.user_resource_limits', 2);
    }

    public static function getModelLabel(): string
    {
        return trans_choice('usercreatableservers::strings.user_resource_limits', 1);
    }

    public static function getPluralModelLabel(): string
    {
        return trans_choice('usercreatableservers::strings.user_resource_limits', 2);
    }

    public static function getNavigationGroup(): ?string
    {
        return config('panel.filament.top-navigation', false) ? null : trans('admin/dashboard.user');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count() ?: null;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.username')
                    ->label(trans_choice('usercreatableservers::strings.user', 1))
                    ->icon('tabler-user')
                    ->url(fn (UserResourceLimits $userResourceLimits) => auth()->user()->can('update', $userResourceLimits->user) ? EditUser::getUrl(['record' => $userResourceLimits->user]) : null),
                TextColumn::make('memory')
                    ->label(trans('usercreatableservers::strings.memory'))
                    ->badge()
                    ->suffix(config('panel.use_binary_prefix') ? ' MiB' : ' MB'),
                TextColumn::make('disk')
                    ->label(trans('usercreatableservers::strings.disk'))
                    ->badge()
                    ->suffix(config('panel.use_binary_prefix') ? ' MiB' : ' MB'),
                TextColumn::make('cpu')
                    ->label(trans('usercreatableservers::strings.cpu'))
                    ->badge()
                    ->suffix('%'),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()
                        ->hidden(fn ($record) => static::canEdit($record)),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->emptyStateIcon('tabler-cube-plus')
            ->emptyStateDescription('');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label(trans_choice('usercreatableservers::strings.user', 1))
                    ->required()
                    ->prefixIcon('tabler-user')
                    ->relationship('user', 'username')
                    ->searchable(['username', 'email'])
                    ->getOptionLabelFromRecordUsing(fn (User $user) => "$user->username ($user->email)")
                    ->selectablePlaceholder(false)
                    ->hiddenOn('edit'),
                TextInput::make('memory')
                    ->label(trans('usercreatableservers::strings.memory'))
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0)
                    ->suffix(config('panel.use_binary_prefix') ? 'MiB' : 'MB')
                    ->hint(trans('usercreatableservers::strings.hint_unlimited')),
                TextInput::make('disk')
                    ->label(trans('usercreatableservers::strings.disk'))
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0)
                    ->suffix(config('panel.use_binary_prefix') ? 'MiB' : 'MB')
                    ->hint(trans('usercreatableservers::strings.hint_unlimited')),
                TextInput::make('cpu')
                    ->label(trans('usercreatableservers::strings.cpu'))
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0)
                    ->suffix('%')
                    ->hint(trans('usercreatableservers::strings.hint_unlimited')),
                TextInput::make('server_limit')
                    ->label(trans('usercreatableservers::strings.server_limit'))
                    ->numeric()
                    ->nullable()
                    ->placeholder(trans('usercreatableservers::strings.no_limit')),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('user.username')
                    ->label(trans_choice('usercreatableservers::strings.user', 1))
                    ->columnSpanFull(),
                TextEntry::make('memory')
                    ->label(trans('usercreatableservers::strings.memory'))
                    ->badge(),
                TextEntry::make('disk')
                    ->label(trans('usercreatableservers::strings.disk'))
                    ->badge(),
                TextEntry::make('cpu')
                    ->label(trans('usercreatableservers::strings.cpu'))
                    ->badge(),
                TextEntry::make('server_limit')
                    ->label(trans('usercreatableservers::strings.server_limit'))
                    ->badge()
                    ->placeholder(trans('usercreatableservers::strings.no_limit')),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageUserResourceLimits::route('/'),
        ];
    }
}
