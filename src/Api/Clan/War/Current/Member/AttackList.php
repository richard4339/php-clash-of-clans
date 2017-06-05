<?php

namespace ClashOfClans\Api\Clan\War\Current\Member;

use ClashOfClans\Api\AbstractResource;

/**
 * Class AttackList
 * @package ClashOfClans\Api\Clan\War\Current\Member
 */
class AttackList extends AbstractResource
{
    protected $casts = [
        'all' => Attack::class
    ];

    /**
     * @return Attack|null
     */
    public function first()
    {
        return $this->get(0);
    }

    /**
     * @return Attack|null
     */
    public function last()
    {
        return $this->get(1);
    }

    /**
     * @return Attack[]
     */
    public function all()
    {
        return $this->get();
    }
}
