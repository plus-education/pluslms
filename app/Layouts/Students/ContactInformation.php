<?php


namespace App\Layouts\Students;

use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class ContactInformation  extends Layout
{
    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'contactInformation';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'ContactInformation';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make(__('Phone')),
        ];
    }
}
