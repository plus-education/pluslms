<?php

namespace Lms\TeacherTopicComment;

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
        return 'Teacher Topic Comment';
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
