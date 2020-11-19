<?php


namespace App\Exports;

use App\Models\Topic;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CourseGradebookExport implements FromView
{
    private  $topic;

    public function __construct($topic)
    {
        $this->topic = $topic;
    }

    public function view(): View
    {
        $topic = Topic::find($this->topic);
        $students = $topic->course->students;
        $activities = $topic->activities->where('score', '>', 0);

        return view('exports.excel.TopicGradebookTable')->with(compact('topic', 'students', 'activities'));
    }
}
