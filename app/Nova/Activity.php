<?php

namespace App\Nova;

use Laravel\Nova\Http\Requests\NovaRequest;

use Eminiarts\Tabs\Traits\HasTabs;
use Eminiarts\Tabs\Tabs;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;

use App\Nova\Text as TextActivity;

use Alexwenzel\DependencyContainer\HasDependencies;
use Alexwenzel\DependencyContainer\DependencyContainer;

//use Lms\ActivityComments\ActivityComments;
//use Lms\ActivityScores\ActivityScores;

use PixelCreation\NovaFieldSortable\Concerns\SortsIndexEntries;
use PixelCreation\NovaFieldSortable\Sortable;

class Activity extends Resource
{
    use HasDependencies, HasTabs, SortsIndexEntries;

    public static $defaultSortField = 'order';

    /**
     * The pagination per-page options configured for this resource.
     *
     * @return array
     */
    public static $perPageOptions = [50, 100, 150];

    /**
     * The number of resources to show per page via relationships.
     *
     * @var int
     */
    public static $perPageViaRelationship = 50;

    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */

    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Activity::class;

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
        'name'
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Activities');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Activity');
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
            BelongsTo::make('Topic'),

            Text::make(__('Name'), 'name')->required()
                ->rules('required'),

            Date::make('Created At', 'created_at')->onlyOnDetail(),

            Date::make(__('Start Date'), 'start'),

            Date::make(__('End Date'), 'end'),

            Boolean::make(__('Required'), 'required')
                ->required()
                ->default(true),

            Boolean::make(__('Show'), 'isShow')
                ->required(),

            \Laravel\Nova\Fields\Number::make(__('Score'), 'score')
                ->min(0)
                ->max(100)
                ->default(0),
 
            /*ActivityScores::make()
                 ->withMeta(['model' => $this->model()])
                 ->canSee(function() {
                     return ($this->score > 0) ? true : false;
                 }),*/
 
            Sortable::make(__("Order"), 'order')
                ->onlyOnIndex(),
 
            Number::make(__("Order"), 'order')
                 ->hideWhenCreating(),

            Heading::make('Content'),

            Select::make(__("Activity Type"), 'activityable_type')->options([
                'App\Models\TypesActivities\H5P' => 'H5P Content',
                'App\Models\TypesActivities\Text' => 'Text',
                'App\Models\TypesActivities\MakeCode' => 'MakeCode Project',
                //Exercise::class,
                //PDF::class,
            ])
                ->displayUsingLabels()
                ->required()
                ->rules('required')
                ->onlyOnForms()
                ->hideWhenUpdating(),

            MorphTo::make(__("Activity Type"), 'Activityable')->types([
                \App\Nova\Text::class,
                H5P::class,
                MakeCode::class,
                //Exercise::class,
                //PDF::class,
            ])
                ->exceptOnForms(),

            DependencyContainer::make((new H5P(null))->fields($request))
                ->dependsOn('activityable_type', 'App\Models\TypesActivities\H5P')
                ->onlyOnForms()
                ->hideWhenUpdating(),

            DependencyContainer::make((new TextActivity(null))->fields($request))
                ->dependsOn('activityable_type', 'App\Models\TypesActivities\Text')
                ->onlyOnForms()
                ->hideWhenUpdating(),

            DependencyContainer::make((new MakeCode(null))->fields($request))
                ->dependsOn('activityable_type', 'App\Models\TypesActivities\MakeCode')
                ->onlyOnForms()
                ->hideWhenUpdating(),

            Heading::make('Meta'),

            /*new Tabs(__('Tools'), [
                ActivityComments::make(),
                    //->typeOfComment('activity'),
            ]),*/
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
        return [];
    }

    /**
     * Get the parent to be displayed in the breadcrumbs.
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function breadcrumbParent()
    {
        return $this->model()->topic;
    }
}
