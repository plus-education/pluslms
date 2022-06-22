<?php

namespace App\Nova\Actions;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;

use App\Models\Course;
use App\Models\TSChannel;

class AssignThingspeakChannel extends Action
{
    use InteractsWithQueue, Queueable;

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

            if ($channel === null) {
                $res = null;

                $client = new Client();
                try {
                    $res = $client->post('https://api.thingspeak.com/channels.json', [
                        'form_params' => [
                            'api_key' => $fields->ts_api,
                            'name' => "Course#{$course->id}:USER#{$model->id}",
                            'public_flag' => true,
                        ]
                    ]);
                } catch (ClientException $e) {
                    Action::danger('Something went wrong!');
                }

                if ($res !== null && $res->getStatusCode() === 200) {
                    $data = json_decode($res->getBody(), true);

                    $channel = TSChannel::create([
                        'channel_id' => $data['id'],
                        'manage_api_key' => $fields->ts_api,
                        'api_key' => $data['api_keys'][0]['api_key'],
                        'user_id' => $model->id,
                        'course_id' => $course->id,
                    ]);
                }
            }
        }

        return Action::message('Assigned Thingspeak channels to users.');
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
            Text::make('Thingspeak API Key', 'ts_api')
                ->rules('required'),

            Select::make('Course')
                ->options($request->user()->courses()->pluck('name', 'id'))
                ->rules('required'),
        ];
    }
}
