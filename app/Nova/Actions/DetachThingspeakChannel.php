<?php

namespace App\Nova\Actions;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;

use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\DestructiveAction;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;

use App\Models\Course;
use App\Models\TSChannel;

class DetachThingspeakChannel extends DestructiveAction
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
            $channel = TSChannel::where([
                'user_id' => $model->id,
                'course_id' => $course->id,
            ])->first();

            if ($channel !== null) {
                $res = null;

                $client = new Client();
                try {
                    $res = $client->delete("https://api.thingspeak.com/channels/{$channel->channel_id}.json", [
                        'form_params' => [
                            'api_key' => $channel->manage_api_key,
                        ]
                    ]);
                } catch (ClientException $e) {
                    Action::danger('Something went wrong!');
                }

                if ($res !== null && $res->getStatusCode() === 200) {
                    $channel->delete();
                }
            }
        }

        return Action::message('Detached Thingspeak channels from users.');
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
                ->options($request->user()->courses()->pluck('name', 'id'))
                ->rules('required'),
        ];
    }
}
