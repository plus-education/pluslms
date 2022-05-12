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
        return 'Activity Comments';
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
}
