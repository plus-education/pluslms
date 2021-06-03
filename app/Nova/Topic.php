<?php

namespace App\Nova;

use App\Nova\Actions\TopicGradebook;
use Eminiarts\Tabs\Tabs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Lms\TeacherTopicComment\TeacherTopicComment;
use MichielKempen\NovaOrderField\Orderable;
use MichielKempen\NovaOrderField\OrderField;
use Monaye\SimpleLinkButton\SimpleLinkButton;

class Topic extends Resource
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
    public static $model = \App\Models\Topic::class;

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
        return __('Topics');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Topic');
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
                ->required()
                ->rules('required', 'max:255')
            ,

            BelongsTo::make(__('Course'), 'Course', Course::class),

            new Tabs(__('Tools'), [
                HasMany::make(__('Activities'), 'Activities', Activity::class),

                TeacherTopicComment::make(),

                HasMany::make('Planificaciones semanales', 'weeklyPlannings', WeeklyPlanning::class),
            ]),

            OrderField::make(__('Order'), 'order'),

            Text::make('Punteo Asignado', 'totalActivities')
                ->hideWhenCreating()
                ->hideWhenUpdating(),

             SimpleLinkButton::make('Calificaciones', function () {
                 return "/topicGradebook/{$this->id}" ;
             })
                 ->type('link')  // fill, outline, link
                 ->attributes(['target' => '_blank']),
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
        return [
        ];
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
        return [
            new TopicGradebook
        ];
    }
}
