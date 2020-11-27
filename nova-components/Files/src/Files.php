<?php

namespace Lms\Files;

use Laravel\Nova\ResourceTool;

class Files extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Files';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'files';
    }
}
