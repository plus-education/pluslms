<?php

namespace App\Nova;

use Laravel\Nova\Http\Requests\NovaRequest;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\MorphToMany;

class UserFields
{
    public static function fields()
    {
        return [
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

            //MorphToMany::make('Roles', 'roles', \Itsmejoshua\Novaspatiepermissions\Role::class),
            //MorphToMany::make('Permissions', 'permissions', \Itsmejoshua\Novaspatiepermissions\Permission::class),

            Boolean::make('Is Solvent', 'is_solvent'),
        ];
    }
}
