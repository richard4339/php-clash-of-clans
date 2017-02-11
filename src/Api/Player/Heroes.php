<?php

namespace ClashOfClans\Api\Player;


use ClashOfClans\Api\AbstractResource;

class Heroes extends AbstractResource
{
    protected $casts = [
        'all' => Hero::class
    ];

    /**
     * @return Hero|null
     */
    public function first()
    {
        return $this->get(0);
    }

    /**
     * @return Hero|null
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