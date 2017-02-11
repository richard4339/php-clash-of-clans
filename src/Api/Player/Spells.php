<?php

namespace ClashOfClans\Api\Player;


use ClashOfClans\Api\AbstractResource;

class Spells extends AbstractResource
{
    protected $casts = [
        'all' => Spell::class
    ];

    /**
     * @return Spell|null
     */
    public function first()
    {
        return $this->get(0);
    }

    /**
     * @return Spell|null
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