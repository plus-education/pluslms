<?php

namespace Lms\TeacherTopicComment;

use App\Nova\User;
use Laravel\Nova\ResourceTool;

class TeacherTopicComment extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Observaciones';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'teacher-topic-comment';
    }
}
