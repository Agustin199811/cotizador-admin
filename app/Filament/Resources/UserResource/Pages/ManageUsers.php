<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Resources\Pages\ManageRecords;
use Filament\Actions;

class ManageUsers extends ManageRecords
{
    protected static string $resource = UserResource::class;
    protected static ?string $title = 'Usuarios';

    protected function getHeaderActions(): array
    {

        return [
            Actions\CreateAction::make()
                ->label('Nuevo Usuario')
                ->modalHeading('Crear Usuario')
                ->visible(fn() => auth()->user()?->hasRole('superadmin'))
                ->using(function (array $data): User {
                    $user = User::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => bcrypt($data['password']),
                    ]);

                    $user->syncRoles([$data['role']]);

                    return $user;
                }),
        ];
    }


}