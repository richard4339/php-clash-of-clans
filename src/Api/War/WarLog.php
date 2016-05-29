<?php


namespace ClashOfClans\Api\War;


use ClashOfClans\Api\AbstractResource;

class WarLog extends AbstractResource
{
    protected $casts = [
        'all' => War::class
    ];

    /**
     * @return array
     */
    public function all()
    {
        return $this->get();
    }
}
