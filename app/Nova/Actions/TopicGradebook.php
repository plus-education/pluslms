<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Nova;

class TopicGradebook extends Action
{
    use InteractsWithQueue, Queueable;


    public $showOnTableRow = true;

    public $showOnIndex = false;

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('Gradebook') ?: Nova::humanize($this);
    }
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        if($fields->format == 'PDF') {
            return Action::redirect('/course/topic/gradebookPdf/' . $models->first()->id);
        }

        return Action::redirect('/course/topic/gradebookExcel/' . $models->first()->id);
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make(__('Format'), 'format')
                ->options([
                    'PDF' => "PDF",
                    'Excel' => "Excel"
                ])
        ];
    }
}
