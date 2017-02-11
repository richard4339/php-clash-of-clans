<?php

namespace ClashOfClans\Api\Player;


use ClashOfClans\Api\AbstractResource;

class Achievements extends AbstractResource
{
    protected $casts = [
        'all' => Achievement::class
    ];

    /**
     * @return Achievement|null
     */
    public function first()
    {
        return $this->get(0);
    }

    /**
     * @return Achievement|null
     */
    public function nth($i)
    {
        return $this->get($i);
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->get();
    }

}