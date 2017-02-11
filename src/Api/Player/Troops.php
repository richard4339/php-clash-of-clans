<?php

namespace ClashOfClans\Api\Player;


use ClashOfClans\Api\AbstractResource;

class Troops extends AbstractResource
{
    protected $casts = [
        'all' => Troop::class
    ];

    /**
     * @return Troop|null
     */
    public function first()
    {
        return $this->get(0);
    }

    /**
     * @return Troop|null
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