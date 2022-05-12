<?php

namespace App\Nova;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\MorphToMany;

use Vyuldashev\NovaPermission\PermissionBooleanGroup;
use Vyuldashev\NovaPermission\RoleSelect;

class UserFields
{
    public static function fields($model = null)
    {
        return [
            Gravatar::make()->maxWidth(50),

            Text::make(__('Name'), 'name' )
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make(__('Email'), 'email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make(__('Password'), 'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            Text::make(__('Code'), 'code' )
                ->sortable()
                ->rules('max:255'),


            RoleSelect::make('Role', 'roles'),
            PermissionBooleanGroup::make('Permissions'),

            Boolean::make('Es solvente', 'is_solvent'),

            Impersonate::make($model)->withMeta([
                'redirect_to' => '/dashboard'
            ]),
        ];
    }
}
