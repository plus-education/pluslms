<?php

namespace App\Nova;

use Advoor\NovaEditorJs\NovaEditorJs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Naoray\NovaJson\JSON;

class DayPlanning extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\DayPlanning::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'day';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'day',
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
            BelongsTo::make('Planificación Semanal', 'weeklyPlanning', WeeklyPlanning::class),

            \Laravel\Nova\Fields\Text::make( 'Dia','day')
                ->required()
                ->rules('required'),


            NovaEditorJs::make(__('Materiales'), 'resources')
                ->hideFromIndex()
                ->required()
                ->rules('required'),

            NovaEditorJs::make(__('Tarea'), 'Homework')
                ->hideFromIndex()
                ->required()
                ->rules('required'),

            Heading::make('Actividades de clase:'),

            JSON::make(__('Actividades de clase'), 'activities', [
                \Laravel\Nova\Fields\Text::make('Reglas de clase')->hideFromIndex(),
                \Laravel\Nova\Fields\Text::make('Tema')->hideFromIndex(),
                \Laravel\Nova\Fields\Text::make('Actividad Inicial')->hideFromIndex(),
                \Laravel\Nova\Fields\Text::make('Proceso de aprendizaje')->hideFromIndex(),
                \Laravel\Nova\Fields\Text::make('Evaluación')->hideFromIndex(),
                \Laravel\Nova\Fields\Text::make('Dudas y respuestas')->hideFromIndex()
            ]),

            DateTime::make('Creado el ', 'created_at')
                ->format('DD-MM-Y h:m')
                ->onlyOnIndex()

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
