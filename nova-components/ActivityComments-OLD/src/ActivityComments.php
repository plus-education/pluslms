<?php

namespace Lms\ActivityComments;

use Laravel\Nova\ResourceTool;

class ActivityComments extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Commentarios de Alumnos ';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'activity-comments';
    }

    public function typeOfComment($type)
    {
        return $this->withMeta(['typeOfcomment' => $type]);
    }

    public function withCourse($course)
    {
        return $this->withMeta(['typeOfcomment' => $course]);
    }
}
