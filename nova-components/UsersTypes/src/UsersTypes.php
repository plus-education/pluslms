<?php

namespace Lms\UsersTypes;

use App\Models\Roles;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Nova;

class UsersTypes extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'users-types';

    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('Rol');
    }

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->role($value)->get();
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
           __('Admins') =>  Roles::ADMIN ,
           __('Teachers') => Roles::TEACHER,
           __('Students') => Roles::STUDENT ,
        ];
    }
}
