<?php

namespace App\Nova\Actions;

use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\DestructiveAction;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;

use App\Models\Course;

class RemoveFromCourse extends DestructiveAction
{
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $course = Course::find($fields->course);
        
        if ($course === null) {
            return Action::danger("Couldn't find course.");
        }

        foreach ($models as $model) {
            $course->users()->detach($model->id);
        }

        return Action::message('Detached users from course');
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Course')
                ->options(Course::all()->pluck('name', 'id'))
                ->rules('required'),
        ];
    }
}
