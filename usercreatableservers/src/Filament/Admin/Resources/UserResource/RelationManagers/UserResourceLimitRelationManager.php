<?php

namespace Boy132\UserCreatableServers\Filament\Admin\Resources\UserResource\RelationManagers;

use App\Models\User;
use Boy132\UserCreatableServers\Filament\Admin\Resources\UserResourceLimitsResource;
use Boy132\UserCreatableServers\Models\UserResourceLimits;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class UserResourceLimitRelationManager extends RelationManager
{
    protected static string $relationship = 'userResourceLimits';

    public function getRelationship(): Relation|Builder
    {
        /** @var User $user */
        $user = $this->getOwnerRecord();

        return $user->hasMany(UserResourceLimits::class);
    }

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        if (static::shouldSkipAuthorization()) {
            return true;
        }

        return UserResourceLimitsResource::canViewAny();
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading(trans_choice('usercreatableservers::strings.user_resource_limits', 2))
            ->columns([
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

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
}
