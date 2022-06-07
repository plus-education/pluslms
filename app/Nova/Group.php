<?php

namespace App\Nova;

use Laravel\Nova\Http\Requests\NovaRequest;

use Eminiarts\Tabs\Traits\HasTabs;
use Eminiarts\Tabs\Tabs;

use App\Nova\Actions\GradebookGroup;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;

class Group extends Resource
{
    use HasTabs;

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
    public function fields(NovaRequest $request)
    {
        return [
            Text::make(__('Name'), 'name')->sortable()->required(),

            Trix::make(__('Description'), 'Description'),

            DateTime::make(__('Start Date'), 'start')
                ->sortable(),

            DateTime::make(__('End Date'), 'end')
                ->sortable(),

            Text::make('Zoom Link', 'zoom')
                ->hideFromIndex(),

            new Tabs('Relations', [
                HasMany::make(__('Courses'), 'Courses', Course::class),

                BelongsToMany::make(__('Students'), 'students', Student::class)
                    ->searchable(),

                BelongsToMany::make(__('Teachers'), 'teachers', Teacher::class)->searchable(),

                BelongsToMany::make(__('Supervisors'), 'supervisors', Supervisor::class)->searchable(),

                BelongsToMany::make(__('Admins'), 'admins', Admin::class),
            ]),

            /*AttachMany::make(__('Students'), 'students', Student::class),

            SimpleLinkButton::make('Notas', function () {
                return "/groupGradebook/{$this->id}" ;
            })
                ->type('link')  // fill, outline, link
                ->attributes(['target' => '_blank']),*/
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
        ];
    }
}
