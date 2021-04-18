<?php


namespace App\Bundles\Notifications\Domain;


class Notification
{
    private $title;

    private $details;

    private $resource_id;

    private $resource_name;

    public function __construct($title, $details, $recource_id, $resource_name)
    {
        $this->title = $title;
        $this->details = $details;
        $this->resource_id = $recource_id;
        $this->resource_name = $resource_name;
    }

    public function toPrimitives(): array
    {
        return [
            'title' => $this->title,
            'details' => $this->details,
            'resourceId' => $this->resource_id,
            'resourceName' => $this->resource_name
        ];
    }

    public function title(): string
    {
        return $this->title;
    }

    public function details(): string
    {
        return $this->details;
    }
}
