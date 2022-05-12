<?php

namespace Lms\ActivityScores;

use Laravel\Nova\ResourceTool;

class ActivityScores extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Activity Scores';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'activity-scores';
    }
}
