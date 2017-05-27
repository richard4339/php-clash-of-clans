<?php

namespace ClashOfClans\Api\Clan\War\Current\Member;

use ClashOfClans\Api\AbstractResource;

/**
 * Class MemberList
 * @package ClashOfClans\Api\Clan\War\Current\Member
 *
 */
class MemberList extends AbstractResource
{
    protected $casts = [
        'all' => Member::class
    ];

    /**
     * @return Member|null
     */
    public function first()
    {
        return $this->get(0);
    }

    /**
     * @return Member|null
     */
    public function nth($i)
    {
        return $this->get($i);
    }

    /**
     * @return Member[]
     */
    public function all()
    {
        return $this->get();
    }
}
