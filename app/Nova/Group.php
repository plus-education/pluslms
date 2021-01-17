<?php

namespace App\Nova;

use Advoor\NovaEditorJs\NovaEditorJs;
use Eminiarts\Tabs\Tabs;
use Illuminate\Http\Request;
use Jrodas4044\GridMultiselectBelogsToMany\GridMultiselectBelogsToMany;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Group extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Group::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Groups');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Group');
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->can('list groups')) {
            return $query->whereKeyNot(1);
        }

        if (auth()->user()->can('list only my groups')) {
            return $query->whereHas('users', function ($q) {
                $q->where('id',auth()->user()->id);
            })
                ->whereKeyNot(1)
                ->get();
        }
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            \Laravel\Nova\Fields\Text::make(__('Name'), 'name')->sortable()->required(),

            NovaEditorJs::make(__('Description'), 'Description'),

            DateTime::make(__('Start Date'), 'start')
                ->sortable()
                ->required(),

            DateTime::make(__('End Date'), 'end')
                ->sortable()
                ->required(),

            new Tabs('Relations', [
                HasMany::make(__('Courses'), 'Courses', Course::class),
                BelongsToMany::make(__('Students'), 'students', Student::class)->searchable(),
                BelongsToMany::make(__('Teachers'), 'teachers', Teacher::class)->searchable(),
                BelongsToMany::make(__('Supervisors'), 'supervisors', Supervisor::class)->searchable(),
            ]),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
