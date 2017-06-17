<?php

namespace ClashOfClans\Api\Clan\War\Current\Member;

use ClashOfClans\Api\AbstractResource;
use ClashOfClans\Api\Clan\URLContainer;

/**
 * Class WarClanMember
 * @package ClashOfClans\Api\Clan\War\Current
 *
 * @property-read string $tag
 * @property-read string $name
 * @property-read int $townhallLevel
 * @property-read int $mapPosition
 * @property-read int $opponentAttacks
 * @property-read AttackList $attacks
 */
class Member extends AbstractResource
{
    protected $casts = [
        'attacks' => AttackList::class
    ];

    /**
     * Gets the count of attacks made by this member
     * 
     * @return int
     */
    public function attackCount()
    {
        $count = $this->get('attacks');

        if(empty($count)) {
            return 0;
        }

        return $count;
    }
}