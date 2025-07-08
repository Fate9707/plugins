<?php

namespace Boy132\UserCreatableServers\Filament\Admin\Resources\UserResourceLimitsResource\Pages;

use Boy132\UserCreatableServers\Filament\Admin\Resources\UserResourceLimitsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageUserResourceLimits extends ManageRecords
{
    protected static string $resource = UserResourceLimitsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->createAnother(false),
        ];
    }
}
