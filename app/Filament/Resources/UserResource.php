<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Usuarios';
    protected static ?string $pluralModelLabel = 'Usuarios';
    protected static ?string $slug = 'usuarios';

    public static function getEloquentQuery(?Builder $query = null): Builder
    {
        $query ??= parent::getEloquentQuery();

        return $query->withTrashed();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nombre'),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->label('Correo'),

                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->dehydrated(fn($state) => filled($state)) // Solo guarda si se escribe
                    ->required(fn(string $operation) => $operation === 'create')
                    ->label('Contraseña'),

                Select::make('role')
                    ->label('Rol')
                    ->options(Role::all()->pluck('name', 'name'))
                    ->required()
                    ->default('admin')
                    ->afterStateHydrated(function (Select $component, $state, $record) {
                        if ($record) {
                            $component->state($record->roles->pluck('name')->first());
                        }
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Nombre'),
                TextColumn::make('email')
                    ->searchable()
                    ->label('Correo'),
                TextColumn::make('roles.name')
                    ->searchable()
                    ->label('Rol'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->label('Fecha de Creación'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->label('Fecha de Actualización'),
                TextColumn::make('deleted_at')
                    ->label('Fecha de Eliminación')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn() => auth()->user()?->hasRole('superadmin'))
                    ->mutateFormDataUsing(function (array $data, $record) {
                        $record->syncRoles([$data['role']]);
                        return $data;
                    }),
                Tables\Actions\DeleteAction::make()->visible(fn() => auth()->user()?->hasRole('superadmin')),
                Tables\Actions\ForceDeleteAction::make()->visible(fn($record) => $record->trashed() && auth()->user()?->hasRole('superadmin')),
                Tables\Actions\RestoreAction::make()->visible(fn($record) => $record->trashed() && auth()->user()?->hasRole('superadmin')),


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }
}
