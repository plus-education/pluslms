<?php

namespace App\Nova;

use Advoor\NovaEditorJs\NovaEditorJs;
use App\Models\Roles;
use DigitalCreative\Filepond\Filepond;
use Eminiarts\Tabs\Tabs;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use NovaAttachMany\AttachMany;
use Spatie\Tags\Tag;

class Course extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Course::class;

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
        'id', 'name', 'code'
    ];


    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Courses');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Course');
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
        if (auth()->user()->can('list courses') && auth()->user()->can('list only my courses')) {
            return $query;
        }

        return $query->whereHas('users', function ($q) {
            $q->where('id',auth()->user()->id);
        })->get();
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
            Text::make(__('Name'), 'name')
                ->sortable()
                ->required()
                ->rules('required', 'max:255'),

            NovaEditorJs::make(__('Description'), 'description'),

            Text::make(__('Code'), 'code')->sortable(),

            Filepond::make(__('Cover'), 'cover')
            ->mimesTypes('image/jpeg,image/png'),

            new Tabs(__('Tools'), [
                HasMany::make(__('Topics'), 'topics', Topic::class),

                BelongsToMany::make(__('Students'), 'students', Student::class)->searchable(),
                BelongsToMany::make(__('Teachers'), 'teachers', Teacher::class)->searchable(),
                BelongsToMany::make(__('Supervisores'), 'supervisors', Supervisor::class)->searchable(),
            ]),

            AttachMany::make(__('Students'), 'students', Student::class),

            BelongsTo::make(__('Group'), 'Group', Group::class)->sortable()
                ->hideWhenCreating(),

            Text::make(__('Class link'), 'classLink'),
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
