<?php

namespace App\Nova;

use DigitalCreative\InlineMorphTo\InlineMorphTo;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Lms\ActivityScores\ActivityScores;
use MichielKempen\NovaOrderField\Orderable;
use MichielKempen\NovaOrderField\OrderField;
use Phalcon\Helper\Number;

class Activity extends Resource
{
    use Orderable;

    public static $defaultOrderField = 'order';

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
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            BelongsTo::make('Topic'),

            Text::make(__('Name'), 'name')->required(),

            Date::make(__('Start Date'), 'start'),

            Date::make(__('End Date'), 'end'),

            Boolean::make(__('Show'), 'isShow')
                ->default(function (){
                    return 0;
                })
                ->required(),


            InlineMorphTo::make('Activityable')->types([
                Divider::class,
                \App\Nova\Text::class,
                File::class,
                Link::class,
                Homework::class,
                PDF::class,
                Youtube::class,
                Test::class,
            ])->required(),


           \Laravel\Nova\Fields\Number::make(__('Score'), 'score')
               ->min(0)
               ->max(100)
               ->default(0),

            ActivityScores::make()
                ->withMeta(['model' => $this->model()]),

            OrderField::make('order'),
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
